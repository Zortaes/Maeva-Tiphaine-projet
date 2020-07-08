<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Article;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/feedback")
 */
class FeedbackController extends AbstractController
{

    /**
     * @Route("/{id}/delete", methods={"GET","POST"}, name="feedbackDelete")
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

}