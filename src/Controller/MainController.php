<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    //public function index(CategoriesRepository $categoriesRepository): Response
    public function index(TricksRepository $tricksRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'tricks' => $tricksRepository->findTricksPaginated(1, '', 15)
            /* 'categories' => $categoriesRepository->findBy([], ['name' => 'asc']) */
        ]);

    }
}
