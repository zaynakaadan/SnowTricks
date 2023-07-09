<?php 

namespace App\Controller;

use App\Entity\Tricks;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tricks", name="tricks_")
 */
class TricksController extends AbstractController
{    
    /**        
     * @Route("/", name="index")
     */
        public function index(): Response
        {
            return $this->render('tricks/index.html.twig');
        }

        //chercher un trick particulier
    /**        
     * @Route("/{slug}", name="details")
     */      
      public function details(Tricks $trick): Response
      {return;
      {
        
        return $this->render('tricks/details.html.twig', compact('trick'));
      }
    }    
