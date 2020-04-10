<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Vote;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class MainController extends AbstractController
{
  
    /**
     * @Route("/", methods={"GET"}, name="homepage")
     * 
     * @return Article[] $lastArticles list of last article (limit 6)
     * @return Article[] $bestArticles list of best Articles (limit 6)
     */
    public function homepage()
    {
        
        /** @var ArticleRepository */
        $lastArticles = $this->getDoctrine()->getRepository(Article::class)->findByLastArticle();

        /** @var VoteRepository */
        $bestArticles = $this->getDoctrine()->getRepository(Vote::class)->findBestArticle();

      

        return $this->render('main/homepage.html.twig', [
            'lastArticles' => $lastArticles,
            'bestArticles' => $bestArticles
            ]);
   

    }

    /**
     * @Route("/a-propos", methods={"GET"}, name="about")
     */
    public function about()
    {   

        return $this->render('main/about.html.twig');
   

    }
}



