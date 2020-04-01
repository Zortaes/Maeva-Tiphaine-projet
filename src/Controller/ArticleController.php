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


/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{

     /**
     * @Route("/nouveau", methods={"GET","POST"}, name="articleNew") 
     */
    public function articleNew(Request $request,  Slugger $slugger): Response
    {

        $newArticle = new Article();
       
        // dummy code - add some example tags to the task
        // (otherwise, the template will render an empty list of tags
        $ingredient1 = new ListIngredient();
        $newArticle->getIngredients()->add($ingredient1);


        $formArticle = $this->createForm(ArticleType::class, $newArticle);
        
        $formArticle->handleRequest($request);

        if ($formArticle->isSubmitted() && $formArticle->isValid()) {

            /* Slug */
            $slugArticle = $formArticle->get('title')->getData();
            $articleSluged = $slugger->sluggify($slugArticle); 
            $newArticle->setSlug($articleSluged); 

            $newArticle->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newArticle);
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

    
