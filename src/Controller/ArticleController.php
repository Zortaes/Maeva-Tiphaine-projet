<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/{slug}", methods={"GET"}, name="articleDetails")
     * 
     */
    public function article(Article $article)
    {

        return $this->render('article/article_details.html.twig',
        [
            'article' => $article
        ]);
       
    }

    
}