<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Vote;
use App\Form\Type\VoteType;
use DateTime;
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
     * @Route("/{slug}/vote", methods={"GET","POST"}, name="vote")
     *
     * @param Article $article
     * @param Request $request
     * @return vote
     */
    public function vote(Article $article, Request $request)
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class, $vote);
        $vote->setArticle($article);
        $vote->setUser($this->getUser());
        $vote->setCreatedAt(new DateTime('now'));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($vote);
            $manager->flush();
        }

        
        return $this->render('article/_vote.html.twig',
        [
            'form' => $form->createView(),
        ]);    
    }

    
}