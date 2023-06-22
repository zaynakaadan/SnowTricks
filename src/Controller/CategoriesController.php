<?php 

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
     * @Route("/categories", name="categories_")
     */
    class CategoriesController extends AbstractController
    {    
        //chercher un trick particulier
    /**        
     * @Route("/{slug}", name="list")
     */      
      public function list(Categories $category): Response
      {
        // je vais chercher la liste des tricks de la catégorie
        $tricks = $category->getTricks()->toArray();
print_r($tricks);die();
        return $this->render('categories/list.html.twig', compact('category' , 'tricks'));
      }
    }    
