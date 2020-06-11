<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Form\Type\EditPasswordType;
use App\Form\Type\EditSelfType;
use App\Services\Slugger;
use App\Form\Type\UserType;
use Symfony\Component\Mime\Email;
use App\Services\EmailConfirmation;
use Symfony\Component\Mime\Address;
use App\Services\AvatarVerification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Config\Definition\Exception\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/utilisateur")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/inscription", name="signup", methods={"GET","POST"})
     * 
     * @param Request $request -> POST 
     * @param UserPasswordEncoderInterface $encoder -> POST 
     * @param Slugger $slugger -> POST 
     * @param MailerInteface $mailer -> POST
     * @param EmailConfirmation $email -> POST
     * 
     * @return $this template form for signup -> GET 
     * @return $this redirect to route login and send email -> POST 
     */
    public function signup(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        Slugger $slugger,
        MailerInterface $mailer,
        EmailConfirmation $confirmation,
        AvatarVerification $avatar
    ): Response {
        $newUser = new User();
        $form = $this->createForm(UserType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

            /* Password */
            $plainPassword = $form->get('plain_password')->getData();
            $encodedPassword = $encoder->encodePassword($newUser, $plainPassword);
            $newUser->setPassword($encodedPassword);

            /* Slug */
            $slugUsername = $form->get('username')->getData();
            $usernameSluged = $slugger->sluggify($slugUsername);
            $newUser->setSlug($usernameSluged);

            /* avatar */
            if ($form->get('avatarFile')->getData() === null) 
            {
                /* Generate a default avatar */
                $avatar->default($newUser);
            }

            /* Add token for signup */
            $newUser->setValidation($confirmation->tokenSignup());

            $newUser->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            /* email */
            $email = (new TemplatedEmail())
                ->from('la.rubrique.ecolo@gmail.com')
                ->to(new Address($newUser->getEmail()))
                ->subject($confirmation->subject())

                // path of the Twig template to render
                ->htmlTemplate('email/_signup.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'id' => $newUser->getId(),
                    'token' => $newUser->getValidation(),
                ]);

            $mailer->send($email);

            $this->addFlash("requestValidationEmail", "Un mail vous a été envoyé pour la confirmation de votre compte, veuillez valider votre inscription depuis votre boîte de réception <" . $newUser->getEmail() . ">");

            return $this->redirectToRoute('login');
        }

        return $this->render('user/new.html.twig', [
            'newUser' => $newUser,
            'unlessFooter' => true,
            'unlessNavbar' => true,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/mon-profil", name="showProfil", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     * 
     * @return $this profil of the user 
     */
    public function showProfil(
    PaginatorInterface $paginator, 
    Request $request, 
    Slugger $slugger, 
    MailerInterface $mailer,
    EmailConfirmation $confirmation)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        /* logout User if he is banned */
        if ($user->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        $userEmail = $user->getEmail();

        $form = $this->createForm(EditSelfType::class, $user);  
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {        
            $newEmail = $form->get('email')->getData();

            if($userEmail != $newEmail)
            {
                $user->setValidate(false);

                /* Add token for email validation */
                $user->setValidation($confirmation->tokenSignup());
            }else
            {
                $user->setValidate(true);
            }

            /* Slug */
            $slugUsername = $form->get('viewUsername')->getData();
            $usernameSluged = $slugger->sluggify($slugUsername); 
            $user->setSlug($usernameSluged); 

            $user->setUpdatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            
            $entityManager->flush();

            $user->setAvatarFile(null);

           /* email */
           if($user->getValidate() == false)
           {
                $email = (new TemplatedEmail())
                ->from('la.rubrique.ecolo@gmail.com')
                ->to(new Address($user->getEmail()))
                ->subject($confirmation->subject())

                // path of the Twig template to render
                ->htmlTemplate('email/_signup.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'id' => $user->getId(),
                    'token' => $user->getValidation(),
                ]);
                    
                $mailer->send($email);

           }

           $this->addFlash("successModifySelf", "Vos changements ont bien été enregistrés");

           return $this->redirectToRoute('showProfil', ['id' => $user->getId()]);
        }


        $articles = $paginator->paginate(
            /** @var ArticleRepository */
            $this->getDoctrine()->getRepository(Article::class)->findBy(["user" => $user]), // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );


        return $this->render('user/profil.html.twig', [
            'user' => $user,
            'articles' => $articles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mon-profil/modifier-mot-de-passe", name="modifyPassword", methods={"GET" , "POST"})
     * 
     * @IsGranted("ROLE_USER")
     * 
     * @return $this redirect to route showProfil 
     * 
     */
    public function modifyPassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        /* logout User if he is banned */
        if ($user->getIsBanned() == true) 
        {
            return $this->redirectToRoute('logout');
        }
        
        

        $form = $this->createForm(EditPasswordType::class, $user);  
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) 
        {        

            /* Password */
            $plainPassword = $form->get('plain_password')->getData();
            $encodedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            $user->setUpdatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("successModifyPassword", "Votre mot de passe a bien été modifié");
        
           return $this->redirectToRoute('showProfil', ['id' => $user->getId()]);

        }

        return $this->render('user/modify_password.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{slug}/supMonCompte", name="deleteAccount", methods={"GET"})
     * 
     * @param User $userParam that we want delete, to compare with the user connected
     * 
     * @return $this redirect to route homepage 
     * 
     */
    public function deleteAccount(User $userParam)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $userCurrent = $this->getUser();


        if ($userCurrent === $userParam) {
            $manager = $this->getDoctrine()->getManager();


            /** @var ArticleRepository */
            $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([
                "user" => $userCurrent
            ]);

            foreach ($articles as $article) {
                $manager->remove($article);
            }

            $manager->remove($userParam);

            $session = new Session();
            $session->invalidate();

            $manager->flush();

            return $this->redirectToRoute('homepage');
        } else {
            throw new Exception('La valeur n\'est pas bonne');
        }
    }

    /**
     * @Route("/{slug}/articles", name="articleByUser")
     *
     * @param User $user that we want sho all his articles
     * @return Articles by user
     */
    public function articleByUser(User $user, PaginatorInterface $paginator, Request $request)
    {

        $articles = $paginator->paginate(
            $this->getDoctrine()->getRepository(Article::class)->findBy(["user" => $user]), // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );


        return $this->render(
            'user/article_by_user.html.twig',
            [
                'user' => $user,
                'articles' => $articles
            ]
        );
    }

    /**
     *  @Route("/validation-reminder", name="validationReminder")
     * 
     *  @return User 
     */
    public function validationReminder()
    {
        $user = $this->getUser();

        return $this->render('email/validation_reminder.html.twig', [
            'user' => $user,
            'unlessFooter' => true,
            'unlessNavbar' => true
        ]);
    }

    /**
     *  @Route("/send_email", name="sendValidationEmail")
     * 
     *  @return User 
     */
    public function sendValidationEmail(MailerInterface $mailer, EmailConfirmation $confirmation)
    {
        $user = $this->getUser();

        $email = (new TemplatedEmail())
        ->from('la.rubrique.ecolo@gmail.com')
        ->to(new Address($user->getEmail()))
        ->subject($confirmation->subject())

        // path of the Twig template to render
        ->htmlTemplate('email/_signup.html.twig')

        // pass variables (name => value) to the template
        ->context([
            'id' => $user->getId(),
            'token' => $user->getValidation(),
        ]);
            
        $mailer->send($email);

        $this->addFlash("successEmailSent", "Un nouvel e-mail vous a été envoyé pour vous permettre de valider votre compte.");

        return $this->redirectToRoute('validationReminder');
    }
}
