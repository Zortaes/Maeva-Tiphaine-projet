<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="ListeDesCategory")
     */
    public function categories()
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        
        return $this->render('_sidebar.html.twig', 
        [
            'categories' => $categories
        ]);
    }
}