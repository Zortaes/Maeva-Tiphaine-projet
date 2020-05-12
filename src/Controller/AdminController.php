<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Entity\Article;
use App\Services\Slugger;
use App\Form\Type\EditUserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/", name="adminBoard")
     * 
     * @return $this template admin Board 
     */
    public function adminBoard()
    {
        
        return $this->render('admin/board.html.twig');
    }



     /**
     * @Route("/utilisateurs", name="showUsers")
     * 
     * @return User[] all Users 
     */
    public function showUsers(Request $request, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var UserRepository */
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $allUsers = $paginator->paginate(
            $users, // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );
        return $this->render('admin/all_users.html.twig', 
        [
            'allUsers' => $allUsers, 
        ]);
    }



     /**
     * @Route("/utilisateurs/{id}", name="userDetails")
     * 
     * @param User $user that we want show details
     * 
     * @return User details  
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
     * @Route("/utilisateurs/{id}/modifier", name="editUser")
     * 
     * @param User $user that we want edit
     * @param Request $request
     * @param Slugger $slugger 
     * 
     * @return User edited  
     */
    public function editUser(User $user, UserPasswordEncoderInterface $encoder, Request $request, Slugger $slugger)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

         // create form and handle
         $form = $this->createForm(EditUserType::class, $user);  
         $form->handleRequest($request);


         if ($form->isSubmitted() && $form->isValid()) {        

            /* Password */
            $plainPassword = $form->get('plain_password')->getData();

            if(!empty($plainPassword)) 
            {
                $encodedPassword = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($encodedPassword); 
            }
          

            /* Slug */
            $slugUsername = $form->get('viewUsername')->getData();
            $usernameSluged = $slugger->sluggify($slugUsername); 
            $user->setSlug($usernameSluged); 

            $user->setUpdatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('userDetails', ['id' => $user->getId()]);
        }

        return $this->render('admin/edit_user.html.twig', [
            'userEdit' => $user,
            'unlessFooter' => true, 
            'unlessNavbar' => true,
            'form' => $form->createView(),
        ]);
    }
 
    



    /**
     * @Route("/articles/signalement", name="articlesFlagged")
     * 
     * @return Article[] list of articles flagged 
     */
    public function articleFlagged(Request $request, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
  

         /** @var ArticleRepository */
         $articlesFlagged = $this->getDoctrine()->getRepository(Article::class)->findByArticlesFlag(1); 

         $allFlag = $paginator->paginate(
            $articlesFlagged, // Request contains data to paginate 
            $request->query->getInt('page', 1), // number current page in URL, 1 if no
            6 // number of result
        );
        
        return $this->render('admin/articles_flag.html.twig', 
        [
            'allFlag' => $allFlag, 
        ]);
    }

    
    /**
     * @Route("/article/{id}/enlever-signalement", methods={"GET"}, name="deleteFlag")
     *
     * @param User $user
     * @return Article flagged = false
     */
    public function deleteFlag(Article $article)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $article->setFlagged(false);

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($article);

        $manager->flush();

        $this->addFlash("successFlagDeleted", "Cet article n'est plus signalé");

        return $this->redirectToRoute('articlesFlagged');
    }


    /**
    * @Route("/utilisateur/{id}/ban", methods={"GET"}, name="banUser")
    *
    * @param User $user that we want banned 
    * @return User is_banned = true
    */
    public function banUser(User $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user->setIsBanned(true);

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($user);

        $manager->flush();

        $this->addFlash("successUserBanned", "Ce compte a bien été banni");

        return $this->redirectToRoute('showUsers');
    }


    /**
    * @Route("/utilisateur/{id}/unban", methods={"GET"}, name="unbanUser")
    *
    * @param User $user
    * @return User is_banned = false
    */
    public function unbanUser(User $user)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user->setIsBanned(false);

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($user);

        $manager->flush();

        $this->addFlash("successUserUnbanned", "Ce compte a bien été débanni");

        return $this->redirectToRoute('showUsers');
    }


    /**
     * @Route("/utilisateur/{id}/supprimer", methods={"GET"}, name="deleteUser")
     *
     * @param User $user that we want delete
     * 
     * @return $this redirect to route on the list of Users 
     */
    public function deleteUser(User $user)
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