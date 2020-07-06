<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\LostPassword\CodePasswordRecoveryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/{id}/{string}/récupération", name="lostPasswordRecovery")
     */
    public function lostPasswordRecovery(User $user, $string, Request $request)
    {

        /* security to access only anonymous */
        if ($this->getUser() !== null)
        {
            $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        }

        /* Request User thanks mail message url */
        if ($user->getValidation() === $string) 
        {

            $formCode = $this->createForm(CodePasswordRecoveryType::class);  
            $formCode->handleRequest($request);


            if ($formCode->isSubmitted() && $formCode->isValid()) 
            {    
            
            // vérifier que cela correspond bien au code inscrit dans la BDD
            
           // Dans une autre fonctionnalité, allez chercher le form que tiphaine a créer pour la modification du mdp et ses fonctions

            dd("cut"); 

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
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');

    }
}
