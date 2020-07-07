<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\Type\EditPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\LostPassword\CodePasswordRecoveryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="login")
     * 
     * @param AuthenticationUtils $authenticationUtils
     * 
     * @return $this redirect to route in the current page 
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', 
        [
            'unlessFooter' => true,
            'unlessNavbar' => true,
            'last_username' => $lastUsername, 
            'error' => $error
        ]);
    }

    /**
     * @Route("/{id}/{string}/validation", name="validate")
     * 
     * @param User $user 
     * @param $string Token validation security
     * 
     * @return $this redirect to Route login 
     * @return \LogicException if the User or/and token no correct
     */
    public function validate(User $user, $string)
    {

        if ($user->getValidation() === $string) 
        {
            $user->setValidate(true);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash("validationEmail", "Votre validation a été prise en compte, vous pouvez à présent vous connecter");

            return $this->redirectToRoute('login'); 
          
        }

        else 
        {
            throw new \LogicException('Invalid'); 
        }
       
       

    }


    /**
     * @Route("/{id}/{string}/recuperation", name="lostPasswordRecovery")
     * 
     * @param User $user => GET
     * @param $string Token validation security => GET
     * @param Request $request => POST (form) 
     * 
     * @return $this render template form for code
     * @return $this redirect to Route login 
     * @return \LogicException if the User or/and token no correct
     */
    public function lostPasswordRecovery(User $user, $string, Request $request)
    {

        /* security to access only anonymous */
        if ($this->getUser() !== null)
        {
            $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        }


        /* Request User thanks to mail message url, Token correct to this user, else exeption*/
        if ($user->getValidation() === $string) 
        {

            /* User enter the code request to his mailbox */
            $formCode = $this->createForm(CodePasswordRecoveryType::class);  
            $formCode->handleRequest($request);


            if ($formCode->isSubmitted() && $formCode->isValid()) 
            {    
            
                $codeForm = $formCode->get('code')->getData(); 

                 /** @var UserRepository Search code to this user in database */ 
                $codeUser = $this->getDoctrine()->getRepository(User::class)->findBy([
                    'code' => $codeForm,
                    'validation' => $string, 
                    'id' => $user->getId()
                ]);

              
                /* Code doesn't exist in database */
                if (empty($codeUser)) 
                { 
                    $this->addFlash("codeNotSuccess", "Le code entré n'est pas correct");
                    
                    return $this->render('security/code_lost_password_recovery.html.twig', [
                        'form' => $formCode->createView(),
                        'unlessFooter' => true,
                        'unlessNavbar' => true,
                    ]);
                }
                else 
                {
                    $secondForm = $this->forward('App\Controller\SecurityController::modifyPasswordRecovery', [
                       'user' => $codeUser[0]
                    ]);
                
                    return $secondForm;
                }

            }

            return $this->render('security/code_lost_password_recovery.html.twig', [
                'form' => $formCode->createView(),
                'unlessFooter' => true,
                'unlessNavbar' => true,
            ]);
          
        }

        else 
        {
            throw new \LogicException('Invalid'); 
        }
       
       

    }

    /**
     * @param User $user 
     * @param Request $request 
     * @param UserPasswordEncoderInterface $encoder 
     * 
     * @return $this redirect to route login 
     * 
     */
    public function modifyPasswordRecovery($user, Request $request, UserPasswordEncoderInterface $encoder)
    {
      
        /* security to access only anonymous */
        if ($this->getUser() !== null)
        {
            $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        }  

        $form = $this->createForm(EditPasswordType::class, $user);  
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) 
        {        

            dd('cut'); 
            /* Password */
            $plainPassword = $form->get('plain_password')->getData();
            $encodedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            $user->setUpdatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("successModifyPassword", "Votre mot de passe a bien été modifié");
        
           return $this->redirectToRoute('login');

        }

        return $this->render('user/modify_password.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

    }
}
