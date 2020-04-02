<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Vote;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/{slug}", methods={"GET", "POST"}, name="articleDetails")
     * 
     */
    public function article(Article $article)
    {    

        return $this->render('article/article_details.html.twig',
        [
            'article' => $article
        ]);   
    }

    /**
     * @Route("/{slug}/post", methods={"POST"}, name="vote")
     * 
     */
    public function vote(Article $article, Request $request, EntityManagerInterface $manager)
    {
        if($request != 'POST')
        {
            http_response_code(403);
        }

        $vote_value = $request->request->get('userVote');

        $vote = $this->getDoctrine()->getRepository(Vote::class)->findOneBy([
            "user" => $this->getUser(),
            "article" => $article
            ]);
        
        if($vote)
        {
            $vote->setVoteValue($vote_value);
            $vote->setUpdatedAt(new DateTime('now'));
            $manager->persist($vote);
            $manager->flush();
        }
        else

            $vote = new Vote();

            if($vote_value >= 1 && $vote_value <= 5)
            {
                

                $vote->setVoteValue($vote_value);
                $vote->setArticle($article);
                $vote->setUser($this->getUser());
                $vote->setCreatedAt(new DateTime('now'));
                $manager->persist($vote);
                $manager->flush();

            }
            else
            {
                throw new Exception('La valeur n\'est pas bonne');
            }

        return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug() ], 301);
       
    }   
    
}