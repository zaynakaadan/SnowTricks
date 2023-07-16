<?php 

namespace App\Controller;

use App\Entity\MyTrait\CreatedAtTrait;
use App\Entity\Tricks;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

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


    /**        
     * @Route("/{slug}", name="details")
     */      
      public function details(Tricks $trick, UserInterface $ui): Response
      {
        $currentDateTime = $trick->getCreatedAt()->format('Y-m-d H:i:s');
        
        $user = $ui->getUserIdentifier();
        return $this->render('tricks/details.html.twig', compact('trick', 'user', 'currentDateTime'));
      }
    }    
