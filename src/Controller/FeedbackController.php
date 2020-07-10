<?php

namespace App\Controller;

use DateTime;

use App\Entity\Feedback;
use App\Entity\Article;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/commentaire")
 */
class FeedbackController extends AbstractController
{

    /**
     * @Route("/{id}/supprimer", methods={"GET","POST"}, name="feedbackDelete")
     * 
     * @return $this template for Article Details -> Get
     * @return $this redirect to route Article Details -> POST 
     */
    public function deleteFeedback(Feedback $feedback)
    {
        /* logout User if he is banned */
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }

        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }

        $article = $feedback->getArticle();

        $this->denyAccessUnlessGranted('DELETE', $feedback);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($feedback);
        $manager->flush();

        $this->addFlash("successFeedbackDeleted", "Votre commentaire a bien été supprimé");

        return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug()], 301);
    }
    
    /**
     * @Route("/{id}/signaler", methods={"GET","POST"}, name="feedbackFlagUp")
     * @param Feedback $feedback
     * 
     * @return $this template for Article Details -> Get
     * @return $this redirect to route Article Details -> POST 
     */
    public function flagUpFeedback(Feedback $feedback)
    {
        /* logout User if he is banned */
        if ($this->getUser()->getIsBanned() == true) {
            return $this->redirectToRoute('logout');
        }
        
        if ($this->getUser()->getValidate() == false) {
            return $this->redirectToRoute('validationReminder');
        }
        
        $article = $feedback->getArticle();

        $feedback->setFlaggedUp(true);

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($feedback);
        $manager->flush();

        $this->addFlash("successFeedbackFlaggedUp", "Votre signalement a bien été pris en compte, nous traîterons votre demande dans les meilleurs délais.");

        return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug()], 301);
    }

    /**
     * @param Feedback $article 
     * @param FormInterface $formFeedback
     * @param Article
     * 
     * @return $this->render() template twig 
     * @return $this->redirectToRoute() articleDetails 
     */
    public function newFeedback($article, $newFeedback)
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

            $feedbacker = $this->getUser();
            $newFeedback->setFlaggedUp(false);
            $newFeedback ->setCreatedAt(new DateTime);
            $newFeedback->setUser($feedbacker);
            $newFeedback->setArticle($article);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newFeedback);
            $entityManager->flush();

            return $this->redirectToRoute('articleDetails', ['slug' => $article->getSlug()], 301);
    }
}