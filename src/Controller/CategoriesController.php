<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/categories", name="categories_")
 */
class CategoriesController extends AbstractController
{
    /**
    * @Route("/{slug}", name="list")
    */
    public function list(Categories $category, TricksRepository $tricksRepository, Request $request): Response
    {
        //je vais chercher le numéro de page dans l'url
        $page = $request->query->getInt('page', 1);
        // je vais chercher la liste des tricks de la catégorie
        
        //$tricks = $category->getTricks();
        $tricks = $tricksRepository->findTricksPaginated($page, $category->getslug(), 4);

        //dd($tricks);
        return $this->render('categories/list.html.twig', compact('category', 'tricks'));
    }

}