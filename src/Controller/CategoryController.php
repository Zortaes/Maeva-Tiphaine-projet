<?php

namespace App\Controller;

use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function articleByCategory(Category $category, Request $request, PaginatorInterface $paginator)
    {

        $articlesByCategory = $paginator->paginate(
            $category->getArticles(), // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6// Nombre de résultats par page
        );

         
  
        return $this->render('category/article_by_category.html.twig',
        [
            'categoryInfo' => $category, 
            'category' => $articlesByCategory
        ]);
    }


}