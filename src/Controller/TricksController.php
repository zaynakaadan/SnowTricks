<?php 

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\MyTrait\CreatedAtTrait;
use App\Entity\Tricks;
use App\Form\CommentsFormType;
use App\Repository\TricksRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\DateTimeImmutable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

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
      public function details($slug, Tricks $trick, UserInterface $ui, Request $request, EntityManagerInterface $em,TricksRepository $tricksRepository): Response
      {    
        $trick = $tricksRepository->findOneBy(['slug' => $slug]); 

        if(!$trick){
          throw new NotFoundHttpException('Pas de trick trouvée');
        }

        $currentDateTime = $trick->getCreatedAt()->format('Y-m-d H:i:s');
        $user = $ui->getUserIdentifier();    

        //Partie commentaires
        $comment = new Comments;
        // Crée le formulaire
        $commentForm = $this->createForm(CommentsFormType::class, $comment);

        $commentForm->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
        if($commentForm->isSubmitted() && $commentForm->isValid()){
          //dd($comment);
          
          $comment->setTrick($trick);
          $data = $commentForm->getData();
            // Attribuer l' utilisateur à la propriété de l'entité
          $data->setUser($this->getUser());
          $em->persist($data);
          $em->flush();
        
        $this->addFlash('success', ' Votre comment a été bien ajouté ');
        return $this->redirectToRoute('tricks_details', ['slug' => $trick->getSlug()]);
        }  
        //return $this->render('tricks/details.html.twig', compact('trick', 'user', 'currentDateTime', 'commentForm'));
        return $this->render('tricks/details.html.twig', [
          'trick' => $trick,
           'user' => $user,
           'currentDateTime' => $currentDateTime,
           'commentForm' => $commentForm->createView()
        ]);
     }
 }    
