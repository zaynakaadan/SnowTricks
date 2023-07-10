<?php

namespace App\Controller\Admin;

use App\Entity\Tricks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



    /**
     * @Route("/admin/tricks", name="admin_tricks_")
     */  
class TricksController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/tricks/index.html.twig');
    }

    /**
     * @Route("/ajout", name="add")
     */
    public function add(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/tricks/index.html.twig');
    }
    /**
     * @Route("/edition/{id}", name="edit")
     */
    public function edit(Tricks $trick): Response
    {
        // Vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('TRICK_EDIT', $trick);
        return $this->render('admin/tricks/index.html.twig');
    }
    /**
     * @Route("/suppression/{id}", name="delete")
     */
    public function delete(Tricks $trick): Response
    {
        // Vérifie si l'utilisateur peut supprimer avec le Voter
        $this->denyAccessUnlessGranted('TRICK_DELETE', $trick);
        return $this->render('admin/tricks/index.html.twig');
    }

}
