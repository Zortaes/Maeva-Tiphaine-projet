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
     * @return Article[] $lastArticles list of last article (limit 5)
     * @return Article[] $bestArticles list of best Articles (limit 5)
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
}



