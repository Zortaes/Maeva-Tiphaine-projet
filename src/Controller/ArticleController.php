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
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Validator\Constraints\Blank;

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
     * @Route("/{slug}/modifier", methods={"GET","POST"}, name="article_update")
     *
     * @return Article edited
     */
    public function articleUpdate(Article $article, Request $request, Slugger $slugger)
    {
        $this->denyAccessUnlessGranted('EDIT', $article);

        // order the existing ingredient into array
        $originalIngredient = $article->getIngredients()->toArray();

        // create form and handle
        $formArticle = $this->createForm(ArticleType::class, $article);  
        $formArticle->handleRequest($request);

        $dataIngredient = $formArticle->get('ingredients')->getData();   



        if ($formArticle->isSubmitted() && $formArticle->isValid()) 
        {

            /* Slug */
            $slugArticle = $formArticle->get('title')->getData();
            $articleSluged = $slugger->sluggify($slugArticle); 
            $article->setSlug($articleSluged);
          

            $entityManager = $this->getDoctrine()->getManager();
            
            /* remove from db ingredients that are no more in the recipe*/
            foreach ($originalIngredient as $ingredient) {
                if (!$article->getIngredients()->contains($ingredient)) {
                    $entityManager->remove($ingredient);
                }
            }
            
            /* for any already existing ingredient, set them to db from ARTICLE entity */
            foreach ($originalIngredient as $ingredient)
            {

                $article->setIngredients($dataIngredient);
                $article->setupdatedAt(new DateTime('now'));

            }

            /* for any new ingredients, set disposition corresponding to their key value */
            foreach($dataIngredient as $key => $value) 
            {
                   
                $disposition = $value->getDisposition();
                
                /* All ingredient except first ingredient */
                if ($disposition === null) 
                { 
                
                    /* in order */
                   $value->setDisposition($key); 

                }
            }

            $entityManager->persist($article);    
            $entityManager->flush(); 
            

                /* Add relation with Article in ListIngredient */
                foreach ($originalIngredient as $ingredient) 
                {
                    /* Add updated at in ListIngredient */
                    foreach ($article->getIngredients() as $ingredient) 
                    {
                        $ingredient->setUpdatedAt(new DateTime('now')); 
                    }
                }

                /* Add relation with Article in ListIngredient for any new ingredient */
                foreach($dataIngredient as $key => $value) 
                {
                    
                    foreach ($article->getIngredients() as $ingredient) 
                    {
                        $ingredient->setArticle($article);
                    }

                }

            
                $entityManager->persist($ingredient);    
                $entityManager->flush(); 

                return $this->redirectToRoute('articleDetails', array('slug'=> $article->getSlug()));
        }   
            
        
        
        return $this->render('article/edit.html.twig', [
            'originalIngredient' => $originalIngredient,
            'article' => $article,
            'form' => $formArticle->createView(),
        ]);
    }


    /**
     * @Route("/{slug}", methods={"GET", "POST"}, name="articleDetails")
     */
    public function article(Article $article)
    {    
        $vote = $this->getDoctrine()->getRepository(Vote::class)->findOneBy([
            "user" => $this->getUser(),
            "article" => $article
            ]);

        return $this->render('article/article_details.html.twig',
        [
            'article' => $article,
            'vote' => $vote
        ]);   
    }

    /**
     * @Route("/{slug}/vote", methods={"POST"}, name="vote")
     * @IsGranted("ROLE_USER")
     * 
     * @return Vote, return a int for vote_value when a user vote for an article
     */
    public function vote(Article $article, Request $request, EntityManagerInterface $manager)
    {

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
    
    /**
     * @Route("/{slug}/signaler", methods={"POST"}, name="flag")
     * @IsGranted("ROLE_USER")
     * 
     * @return Flagged, return a boolean when the article get flagged
     */
    public function flag(Article $article, Request $request, EntityManagerInterface $manager)
    {
        $flag = $request->request->get('flag');

        if(filter_var($flag, FILTER_VALIDATE_BOOLEAN))
        {
        
            $article->setFlagged(true);
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'Le signalement a bien été pris en compte, nous traîtons votre demande.');

            return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug() ], 301);

        }
        else
        
            throw new Exception('La valeur n\'est pas bonne');
        
    }

    /**
     * @Route("/{slug}/supprimer", name="article_delete")
     * 
     * @return Article deleted
     */
    public function delete(Article $article)
    {  

        $this->denyAccessUnlessGranted('DELETE', $article);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();

        $this->addFlash("info", "L'article a bien été supprimé");

        return $this->redirectToRoute('homepage');

    }
       
}

    
