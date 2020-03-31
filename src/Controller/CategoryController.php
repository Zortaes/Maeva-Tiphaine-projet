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
     * @Route("/", name="CategoriesList")
     */
    public function categories()
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        
        return $this->render('_navbar.html.twig',
        [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{slug}", name="articleByCategory")
     */
    public function articleByCategory(Category $category)
    {
  
        return $this->render('category/article_by_category.html.twig',
        [
            'category' => $category
        ]);
    }


}