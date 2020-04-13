<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="adminBoard")
     */
    public function adminBoard()
    {
        
        return $this->render('admin/board.html.twig');
    }

     /**
     * @Route("/utilisateurs", name="showUsers")
     */
    public function showUsers()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var UserRepository */
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        
        return $this->render('admin/all_users.html.twig', 
        [
            'users' => $users, 
        ]);
    }



}