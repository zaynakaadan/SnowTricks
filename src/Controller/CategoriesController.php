<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
        // Get the value of the "page" variable from the request query
        $page = $request->query->getInt('page', 1);

        // If the request is an AJAX request, return a JSON response
        if ($request->isXmlHttpRequest()) {
            $paginator = $tricksRepository->findTricksPaginated($page, $category->getslug(), 2);
            $tricks = $paginator->getItems();

            $html = $this->renderView('categories/_tricks.html.twig', ['tricks' => $tricks]);

            // Create the response data as an associative array
            $responseData = [
                'html' => $html,
                'hasNextPage' => $paginator->count() > ($page * 2),
            ];

            // Return the data as a JSON response
            return new JsonResponse($responseData);
        }

        // For regular requests, return the full template as before
        return $this->render('categories/list.html.twig',  [
            'category' => $category,
            'tricks' => $tricksRepository->findTricksPaginated($page, $category->getslug(), 2),
            'page' => $page,
        ]);
    }
}
