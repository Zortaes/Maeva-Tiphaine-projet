<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Services\Slugger;
use App\Form\Type\UserType;
use Symfony\Component\Mime\Email;
use App\Services\EmailConfirmation;
use Knp\Component\Pager\PaginatorInterface;
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
     * 
     * @return $this template form for signup -> GET 
     * @return $this redirect to route homepage -> POST 
     */
    public function signup(
        Request $request, 
        UserPasswordEncoderInterface $encoder, 
        Slugger $slugger, 
        MailerInterface $mailer, 
        EmailConfirmation $confirmation): Response
    {
        $newUser = new User();
        $form = $this->createForm(UserType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {        

            /* Password */
            $plainPassword = $form->get('plain_password')->getData();
            $encodedPassword = $encoder->encodePassword($newUser, $plainPassword);
            $newUser->setPassword($encodedPassword);

            /* Slug */
            $slugUsername = $form->get('username')->getData();
            $usernameSluged = $slugger->sluggify($slugUsername); 
            $newUser->setSlug($usernameSluged); 

         
            $newUser->setValidation($confirmation->tokenSignup()); 
            $newUser->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            $message = $confirmation->message($newUser->getId(), $newUser->getValidation()); 

            $email = (new Email())
            ->from('la.rubrique.ecolo@gmail.com')
            ->replyTo('la.rubrique.ecolo@gmail.com')
            ->to($newUser->getEmail())
            ->subject($confirmation->subject())
            ->html($message);

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
     * @Route("/mon-profil", name="showProfil", methods={"GET"})
     * @IsGranted("ROLE_USER")
     * 
     * @return $this profil of the user 
     */
    public function showProfil(PaginatorInterface $paginator, Request $request)
    {
        
        $user = $this->getUser(); 

        /* logout User if he is banned */
        if($user->getIsBanned() == true)
        {
            return $this->redirectToRoute('logout');
        }


        $articles = $paginator->paginate
        (
            /** @var ArticleRepository */
            $this->getDoctrine()->getRepository(Article::class)->findBy(["user" => $user]), // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );
      
        
        return $this->render('user/profil.html.twig', [
          'user' => $user, 
          'articles' => $articles,         
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
       

        if ($userCurrent === $userParam)
        {
            $manager = $this->getDoctrine()->getManager();


            /** @var ArticleRepository */
            $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([
            "user" => $userCurrent
            ]);
      
            foreach ($articles as $article) 
            {
                $manager->remove($article);
            }

            $manager->remove($userParam);
            
            $session = new Session();
            $session->invalidate();

            $manager->flush();

            return $this->redirectToRoute('homepage');
        }
        
        else 

        {
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

        $articles = $paginator->paginate
        (
            $this->getDoctrine()->getRepository(Article::class)->findBy(["user" => $user]), // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );


        return $this->render('user/article_by_user.html.twig',
        [
            'user' => $user,
            'articles' => $articles
        ]);
    }

    
}