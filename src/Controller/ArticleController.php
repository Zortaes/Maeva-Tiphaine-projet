<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Services\Slugger;
use App\Entity\ListIngredient;
use App\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{

     /**
     * @Route("/nouveau", methods={"GET","POST"}, name="articleNew") 
     * @IsGranted("ROLE_USER")
     */
    public function articleNew(Request $request,  Slugger $slugger): Response
    {

        $newArticle = new Article();

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        
        $ingredient = new ListIngredient();
        $ingredient->setDisposition(1); 
        $newArticle->getIngredients()->add($ingredient);

      


        $formArticle = $this->createForm(ArticleType::class, $newArticle);
        
        $formArticle->handleRequest($request);

        if ($formArticle->isSubmitted() && $formArticle->isValid()) {

            /* Slug */
            $slugArticle = $formArticle->get('title')->getData();
            $articleSluged = $slugger->sluggify($slugArticle); 
            $newArticle->setSlug($articleSluged);
        
            $dataIngredient = $formArticle->get('ingredients')->getData();   

           
            foreach($dataIngredient as $key => $value) {
                   
                $disposition = $value->getDisposition();

                if ($disposition === null) {
                    
                   $value->setDisposition(2); 
                               
                }
            }

       
            $newArticle->setFlagged(0); 
            $newArticle->setUser($user);
           
            $newArticle->addIngredient($ingredient); 

            
            $newArticle->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
           
            $entityManager->persist($newArticle);
        
            $entityManager->flush();

          

            foreach ($newArticle->getIngredients() as $ingredient) {
                $ingredient->setArticle($newArticle); 
            }

           
            $ingredient->setArticle($newArticle);
            $entityManager->persist($ingredient);
        
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('article/new.html.twig', [
            'newArticle' => $newArticle,
            'form' => $formArticle->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", methods={"GET"}, name="articleDetails") 
     */
    public function article(Article $article)
    {

        return $this->render('article/article_details.html.twig',
        [
            'article' => $article
        ]);
       
    }

    
       
}

    
