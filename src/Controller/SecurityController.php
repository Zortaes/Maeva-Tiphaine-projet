<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\Type\LostPassword\PasswordReviewalType;
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

        return $this->render(
            'security/login.html.twig',
            [
                'unlessFooter' => true,
                'unlessNavbar' => true,
                'last_username' => $lastUsername,
                'error' => $error
            ]
        );
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

        if ($user->getValidation() === $string) {
            $user->setValidate(true);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash("validationEmail", "Votre validation a été prise en compte, vous pouvez à présent vous connecter");

            return $this->redirectToRoute('login');
        } else {
            throw new \LogicException('Invalid');
        }
    }


    /**
     * @Route("/{id}/{string}/recuperation", name="lostPasswordRecovery")
     * 
     * @param User $user => GET
     * @param $string Token validation security => GET
     * @param Request $request => form 
     * 
     * @return \LogicException if the User or/and token no correct (0)
     * 
     * @return $this->render() template form for code (1)
     * @return $this->forward() for processing Data form code (2)
     * 
     * @return $this->render() template form for renewal password if the form code is submit and processed (3)
     * @return $this->forward() for processing Data form Password (4)
     * 
     */
    public function lostPasswordRecovery(User $user, $string, Request $request)
    {

        /* security to access only anonymous */
        if ($this->getUser() !== null) {
            $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        }

        /********************************************************************** 
        0 - Request User thanks to mail message url, Token correct to this user, 
        - Else exeption 
         ***********************************************************************/
        if ($user->getValidation() === $string) {


            /***************************************************************** 
            3 - Data to the confidential code is already processed and correct 
             ******************************************************************/
            if ($user->getCode() === NULL) {

                $formPassword = $this->createForm(PasswordReviewalType::class, $user);
                $formPassword->handleRequest($request);

                /*******************************
                4 - Data formPassword Processing
                ********************************/
                if ($formPassword->isSubmitted() && $formPassword->isValid()) {

                    $postFormPassword = $this->forward('App\Controller\SecurityController::passwordRenewal', [
                        'user' => $user,
                        'formPassword' => $formPassword,
                        'string' => $string,
                    ]);

                    return $postFormPassword;
                }

                return $this->render('user/modify_password.html.twig', [
                    'user' => $user,
                    'form' => $formPassword->createView()
                ]);
            }


            /*********************************************** 
            1 - Data to the confidential code was not processed
            User enter the code request to his mailbox
             ***********************************************/
            $formCode = $this->createForm(CodePasswordRecoveryType::class);
            $formCode->handleRequest($request);


            if ($formCode->isSubmitted() && $formCode->isValid()) {

                /****************************
                 2 - Data formCode processing 
                 ***************************/
                $postFormCode = $this->forward('App\Controller\SecurityController::code', [
                    'user' => $user,
                    'formCode' => $formCode,
                    'string' => $string,


                ]);

                return $postFormCode;
            }


            return $this->render('security/code_lost_password_recovery.html.twig', [
                'form' => $formCode->createView(),
                'unlessFooter' => true,
                'unlessNavbar' => true,
            ]);
        } else {
            throw new \LogicException('Invalid');
        }
    }

    /**
     * 2 - Data formCode processing
     * 
     * @param User $user 
     * @param FormInterface $formCode
     * @param $string Token validation security
     * 
     * @return $this->render() template twig if the code doesn't ok
     * @return $this->redirectToRoute() lostPasswordRecovery if is ok. And set code NULL
     * 
     */
    public function code($user, $formCode, $string)
    {

        /* security to access only anonymous */
        if ($this->getUser() !== null) {
            $this->denyAccessUnlessGranted('IS_ANONYMOUS');
        }

        $codeForm = $formCode->get('code')->getData();

        /** @var UserRepository Search code to this user in database */
        $codeUser = $this->getDoctrine()->getRepository(User::class)->findBy([
            'code' => $codeForm,
            'validation' => $string,
            'id' => $user->getId()
        ]);


        /* Code doesn't exist in database */
        if (empty($codeUser)) {
            $this->addFlash("codeNotSuccess", "Le code n'est pas correct");

            return $this->render('security/code_lost_password_recovery.html.twig', [
                'form' => $formCode->createView(),
                'unlessFooter' => true,
                'unlessNavbar' => true,
            ]);
        }

        $user->setCode(NULL);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('lostPasswordRecovery', ['id' => $user->getId(), 'string' => $string]);
    }



     /**
     * 4 - Data formPassword Processing
     * 
     * @param User $user 
     * @param FormInterface $formCode
     * @param UserPasswordEncoderInterface $encoder
     * 
     * @return $this redirect to route homepage
     * 
     */
    public function passwordRenewal($user, $formPassword, UserPasswordEncoderInterface $encoder)
    {

        /* Password */
        $plainPassword = $formPassword->get('plain_password')->getData();
        $encodedPassword = $encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        $user->setUpdatedAt(new DateTime('now'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash("successPasswordRenewal", "Votre mot de passe a bien été modifié, vous pouvez maintenant vous connecter");

        return $this->redirectToRoute('homepage');
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
