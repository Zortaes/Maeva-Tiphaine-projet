<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Services\Slugger;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder, Slugger $slugger): Response
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

            $newUser->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/new.html.twig', [
            'newUser' => $newUser,
            'unlessFooter' => true, 
            'unlessNavbar' => true,
            'form' => $form->createView(),
        ]);
    }

}