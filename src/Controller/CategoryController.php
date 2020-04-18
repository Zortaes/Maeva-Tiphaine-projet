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
     * 
     * @return Category[] List of categories in the navbar 
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
     * 
     * @param Category $category that we want details (articles in this category)
     * 
     * @return Category details of this category 
     */
    public function articleByCategory(Category $category)
    {
  
        return $this->render('category/article_by_category.html.twig',
        [
            'category' => $category
        ]);
    }


}