<?php

namespace App\Controller;

use DateTime;
use Exception;

use App\Entity\Flag;
use App\Entity\Vote;
use App\Entity\Article;
use App\Entity\Feedback;
use App\Entity\ListIngredient;

use App\Form\Type\FlagType;
use App\Form\Type\ArticleType;
use App\Form\Type\FeedbackType;

use App\Services\Slugger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{

    /**
     * @Route("/nouveau", methods={"GET","POST"}, name="articleNew") 
     * @IsGranted("ROLE_USER")
     * 
     * @param Request $request -> POST
     * @param Slugger $slugger -> POST 
     * 
     * @return $this template for new Article -> Get
     * @return $this redirect to route Article Details -> POST 
     * 
     */
    public function articleNew(Request $request,  Slugger $slugger): Response
    {
        // si l'utilsateur a été banni, il sera déconnecté
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

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

            foreach ($dataIngredient as $key => $value) {

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

            return $this->redirectToRoute('articleDetails', ['slug' => $newArticle->getSlug()]);
        }

        return $this->render('article/new.html.twig', [
            'newArticle' => $newArticle,
            'form' => $formArticle->createView(),
        ]);
    }




    /**
     * @Route("/{slug}/modifier", methods={"GET","POST"}, name="article_update")
     * 
     * @param Request $request -> POST
     * @param Slugger $slugger -> POST 
     * @param Article $article that we want edited 
     *
     * @return Article edited
     */
    public function articleUpdate(Article $article, Request $request, Slugger $slugger)
    {

        $this->denyAccessUnlessGranted('EDIT', $article);

        // si l'utilsateur a été banni, il sera déconnecté
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

        // order the existing ingredient into array
        $originalIngredient = $article->getIngredients()->toArray();

        // create form and handle
        $formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);

        $dataIngredient = $formArticle->get('ingredients')->getData();



        if ($formArticle->isSubmitted() && $formArticle->isValid()) {

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
            foreach ($originalIngredient as $ingredient) {

                $article->setIngredients($dataIngredient);
                $article->setupdatedAt(new DateTime('now'));
            }

            /* for any new ingredients, set disposition corresponding to their key value */
            foreach ($dataIngredient as $key => $value) {

                $disposition = $value->getDisposition();

                /* All ingredient except first ingredient */
                if ($disposition === null) {

                    /* in order */
                    $value->setDisposition($key);
                }
            }

            $entityManager->persist($article);
            $entityManager->flush();


            /* Add relation with Article in ListIngredient */
            foreach ($originalIngredient as $ingredient) {
                /* Add updated at in ListIngredient */
                foreach ($article->getIngredients() as $ingredient) {
                    $ingredient->setUpdatedAt(new DateTime('now'));
                }
            }

            /* Add relation with Article in ListIngredient for any new ingredient */
            foreach ($dataIngredient as $key => $value) {

                foreach ($article->getIngredients() as $ingredient) {
                    $ingredient->setArticle($article);
                }
            }


            $entityManager->persist($ingredient);
            $entityManager->flush();

            return $this->redirectToRoute('articleDetails', array('slug' => $article->getSlug()));
        }



        return $this->render('article/edit.html.twig', [
            'originalIngredient' => $originalIngredient,
            'article' => $article,
            'form' => $formArticle->createView(),
        ]);
    }




    /**
     * @Route("/{slug}", methods={"GET", "POST"}, name="articleDetails")
     * 
     * @param Article $article that we want show details 
     * 
     * @return Article details 
     */
    public function article(Article $article, Request $request)
    {

        /** @var VoteRepository */
        $vote = $this->getDoctrine()->getRepository(Vote::class)->findOneBy([
            "user" => $this->getUser(),
            "article" => $article
        ]);

         /** @var FlagRepository */
        $flag = $this->getDoctrine()->getRepository(Flag::class)->findOneBy([
            "user" => $this->getUser(),
            "article" => $article
        ]);

        /** @var FeedingRepository */
        $existingFeedback= $this->getDoctrine()->getRepository(Feedback::class)->findOneBy([
            "user" => $this->getUser(),
            "article" => $article
        ]);
        
        $article_id = $article->getId();
        /** @var FeedbackRepository */
        $feedback = $this->getDoctrine()->getRepository(Feedback::class)->findbyDate($article_id);
        

        /********
        FORM FLAG
        ********/
        $newFlag = new Flag();
        $formFlag = $this->createForm(FlagType::class, $newFlag);
        $formFlag->handleRequest($request);

        if ($formFlag->isSubmitted() && $formFlag->isValid() && $flag === null) 
        {

            $postFormFeedback = $this->forward('App\Controller\ArticleController::formFlagArticle', [
                'article' => $article,
                'newFlag' => $newFlag,
                'formFlag' => $formFlag
            ]);

            return $postFormFeedback;

        }

        /* See to the template the posibility for flag an article or no */
        ($flag === null) ? $flag = false : $flag = true; 
         

        /************
        FORM FEEDBACK 
        ************/
        $newFeedback = new Feedback();
        $formFeedback = $this->createForm(FeedbackType::class, $newFeedback);
        $formFeedback->handleRequest($request);

        if ($formFeedback->isSubmitted() && $formFeedback->isValid() && !$existingFeedback) 
        {

            $postFormFeedback = $this->forward('App\Controller\FeedbackController::newFeedback', [
                'article' => $article,
                'newFeedback' => $newFeedback
            ]);

            return $postFormFeedback;
        }

        return $this->render(
            'article/article_details.html.twig',
            [
                'form' => $formFlag->createView(),
                'formFeedback' => $formFeedback->createView(),
                'article' => $article,
                'vote' => $vote,
                'flag' => $flag,
                'feedback' => $existingFeedback,
                'allFeedback' => $feedback
            ]
        );
    }




    /**
     * @Route("/{slug}/vote", methods={"POST"}, name="vote")
     * @IsGranted("ROLE_USER")
     * 
     * @param Article $article that we want vote 
     * @param Request $request 
     * @param EntityManagerInterface $manager 
     * 
     * @return Vote, return a int for vote_value when a user vote for an article
     */
    public function vote(Article $article, Request $request, EntityManagerInterface $manager)
    {

        $user = $this->getUser();

        /* logout User if he is banned */
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

        $vote_value = $request->request->get('userVote');

        $vote = $this->getDoctrine()->getRepository(Vote::class)->findOneBy([
            "user" => $user,
            "article" => $article
        ]);

        if ($vote) {
            $vote->setVoteValue($vote_value);
            $vote->setUpdatedAt(new DateTime('now'));
            $manager->persist($vote);
            $manager->flush();
        } else

            $vote = new Vote();

        if ($vote_value >= 1 && $vote_value <= 5) {
            $vote->setVoteValue($vote_value);
            $vote->setArticle($article);
            $vote->setUser($user);
            $vote->setCreatedAt(new DateTime('now'));
            $manager->persist($vote);
            $manager->flush();
        } else {
            throw new Exception('La valeur n\'est pas bonne');
        }

        return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug()], 301);
    }



    /**
     * @Route("/{slug}/supprimer", name="article_delete")
     * 
     * @param Article $article that we want delete 
     * 
     * @return $this Redirect to route homepage
     */
    public function delete(Article $article)
    {
        /* logout User if he is banned */
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

        $this->denyAccessUnlessGranted('DELETE', $article);


        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();

        $this->addFlash("successArticleDelete", "L'article a bien été supprimé");

        return $this->redirectToRoute('showProfil');
    }

    /**
     * @param Article $article 
     * @param FormInterface $formFlag
     * @param Flag
     * 
     * @return $this->render() template twig 
     * @return $this->redirectToRoute() articleDetails 
     */
    public function formFlagArticle($article, $formFlag, $newFlag)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /* logout User if he is banned */
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        /* If user change his email and don't validate this */
        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

        /* Requests */
        $formFlagValue = $formFlag->get('option_value')->getData();
        $flagger = $this->getUser();

        /* set in the BDD Flag */
        $newFlag->setOptionValue($formFlagValue);
        $newFlag->setUser($flagger);
        $newFlag->setArticle($article);
        $newFlag->setCreatedAt(new Datetime);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newFlag);
        $entityManager->flush();

        $article->setFlagged(true);
        $entityManager->persist($article);
        $entityManager->flush();

        $this->addFlash('success', 'Le signalement a bien été pris en compte, nous traîtons votre demande dans les meilleurs délais.');

        return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug()], 301);
    }
}
