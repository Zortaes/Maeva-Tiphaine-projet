<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;

use App\Services\Slugger;
use App\Entity\ListIngredient;
use App\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Vote;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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
        
        /* For the first ingredient */
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
        
            /* Get all of ingredients, in collection of Article */
            $dataIngredient = $formArticle->get('ingredients')->getData();   

            foreach($dataIngredient as $key => $value) {
                   
                $disposition = $value->getDisposition();
                
                /* All ingredient except first ingredient */
                if ($disposition === null) { 
                
                    /* in order */
                   $value->setDisposition($key); 

                }
            }
           
            /* Add Flagged to false, User author, ingredients and created At*/
            $newArticle->setFlagged(0); 
            $newArticle->setUser($user);           
            $newArticle->addIngredient($ingredient);   
            $newArticle->setCreatedAt(new DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();     
            $entityManager->persist($newArticle);    
            $entityManager->flush();        

            /* Add relation with Article in ListIngredient */
            foreach ($newArticle->getIngredients() as $ingredient) {
                $ingredient->setArticle($newArticle); 
            }

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
     * @Route("/{slug}", methods={"GET", "POST"}, name="articleDetails")
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

    
