<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Article;
use Exception;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

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

     /**
     * @Route("/utilisateurs/{id}", name="userDetails")
     */
    public function userDetails(User $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var UserRepository */
        $user = $this->getDoctrine()->getRepository(User::class)->find($user);
        

         /** @var ArticleRepository */
         $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([
            "user" => $user
        ]);

        
        return $this->render('admin/user_details.html.twig', 
        [
            'articles' => $articles, 
            'user' => $user, 
        ]);
    }

    /**
     * @Route("/utilisateur/{id}/supprimer", name="deleteUser")
     *
     * @param User $user
     */
    public function deleteUser(User $user, Security $security)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    
            $manager = $this->getDoctrine()->getManager();


                /** @var ArticleRepository */
                $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([
                "user" => $user
                ]);
      
            foreach ($articles as $article) 
            {
                $manager->remove($article);
            }

            $manager->remove($user);

            $manager->flush();

            $this->addFlash("infoUserDelete", "Ce compte a bien été supprimé");


            return $this->redirectToRoute('showUsers');
 
    }


}