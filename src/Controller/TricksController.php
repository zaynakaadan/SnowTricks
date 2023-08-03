<?php

namespace App\Controller;

use id;
use App\Entity\Users;
use App\Entity\Tricks;
use DateTimeInterface;
use App\Entity\Comments;
use App\Form\CommentsFormType;
use Monolog\DateTimeImmutable;


use App\Form\EditCommentFormType;
use App\Repository\TricksRepository;
use App\Entity\MyTrait\CreatedAtTrait;
use App\Repository\CommentsRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
/**
 * @Route("/tricks", name="tricks_")
 */
class TricksController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index(CategoriesRepository $categoriesRepository, TricksRepository $tricksRepository): Response
    {

      $categories = $categoriesRepository->findAll();
        $tricks = $tricksRepository->findAllTricks();

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'tricks' => $tricks,
      ]);
    }


    /**
    * @Route("/load", name="load")
    */
    public function getTricks(Request $request, TricksRepository $tricksRepository) {
        $page = $request->query->get('page') ?? 1;
        $tricks = $tricksRepository->findTricksPaginated($page, '', 15);
        // var_dump($tricks);
        return $this->render('tricks/load.html.twig', ['tricks' => $tricks['data']]);
    }

    public function deleteTrick($id) {

    }


    /**
     * @Route("/{slug}", name="details")
     */
      public function details($slug, Tricks $trick,  Request $request, EntityManagerInterface $em,TricksRepository $tricksRepository): Response
      {

        $trick = $tricksRepository->findOneBy(['slug' => $slug]);

        if(!$trick){
          throw new NotFoundHttpException('Pas de trick trouvée');
        }
        $user = $this->getUser();
        $currentDateTime = $trick->getCreatedAt()->format('Y-m-d H:i:s');
        //$user = $ui->getUserIdentifier();

        //Partie commentaires
        $comment = new Comments;
        // Crée le formulaire
        $commentForm = $this->createForm(CommentsFormType::class, $comment);

        $commentForm->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
        if($commentForm->isSubmitted() && $commentForm->isValid()){
          //dd($comment);
          if (!$this->getUser()) {
            throw new AccessDeniedException('Vous devez être connecté pour ajouter un commentaire.');
        }
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

      /**
     * @Route("/comment", name="comment", methods={"GET"})
     */
    public function comment(Request $request, Tricks $trick, TricksRepository $tricksRepository, EntityManagerInterface $em) {
        //$commentText= $request->get('comment');
        $trickId = $request->query->get('trick_id');
        $trick = $tricksRepository->find($trickId);

        //Partie commentaires
        $comment = new Comments;
        // Crée le formulaire
        $commentForm = $this->createForm(CommentsFormType::class, $comment);

        $commentForm->handleRequest($request);

        // Vérifie si le formulaire est soumis et valide
        if($commentForm->isSubmitted() && $commentForm->isValid()){
          
          //dd($comment);
          if (!$this->getUser()) {
            throw new AccessDeniedException('Vous devez être connecté pour ajouter un commentaire.');
        }
          $comment->setTrick($trick);
          $data = $commentForm->getData();
          
            // Attribuer l' utilisateur à la propriété de l'entité
          $data->setUser($this->getUser());
          $em->persist($data);
          $em->flush();

        $this->addFlash('success', ' Votre comment a été bien ajouté ');
        return $this->redirectToRoute('tricks_details', ['slug' => $trick->getSlug()]);
        }
        $user = $this->getUser();
        $currentDateTime = $trick->getCreatedAt()->format('Y-m-d H:i:s');
        //return $this->render('tricks/details.html.twig', compact('trick', 'user', 'currentDateTime', 'commentForm'));
        return $this->render('tricks/details.html.twig', [
          'trick' => $trick,
           'user' => $user,
           'currentDateTime' => $currentDateTime,
           'commentForm' => $commentForm->createView()
        ]);
    }

    /**
     * @Route("/comment/{id}", name="editcomment", methods={"GET","PUT", "POST"})
     */
    public function editcomment(Request $request,$id, Comments $comment, Tricks $trick, EntityManagerInterface $entityManager, TricksRepository $tricksRepository) {
       // $commentText= $request->get('comment'); 
       $trick = $tricksRepository->find($id);
    if (!$trick) {
        throw $this->createNotFoundException('Objet Tricks introuvable avec l id.');
    }
      
                // Crée le formulaire
                $commentForm = $this->createForm(EditCommentFormType::class, $comment );

                // Traite la requete du formulaire
                $commentForm->handleRequest($request);
                //dd($trickForm);
        
                // Vérifie si le formulaire est soumis et valide
                if($commentForm->isSubmitted() && $commentForm->isValid()){                                         
                    // Stoker les information dans bdd
        
            $entityManager->flush();
                    $this->addFlash('success', 'Comment modifié avec succès');
        
                    // Redirige 
                    return $this->redirectToRoute('tricks_index');        
                }
        
                return $this->render('comments/edit.html.twig', [
                    'commentForm'=> $commentForm->createView(),
                    'comment' => $comment, 
                    'trick' => $trick,
                ]);      
    }

     /**
     * @Route("/comment/{id}", name="deletecomment", methods={"DELETE"})
     */
    public function deletecomment(Request $request,Comments $comment, TricksRepository $tricksRepository,EntityManagerInterface $entityManager, CommentsRepository $commentsRepository) {
       // $commentText= $request->get('comment');
        // save the comment       
   
           
          // Supprimer le comment entity
              $entityManager->remove($comment);
              $entityManager->flush();
              $this->addFlash('success', 'Comment à été supprimé ');
            
           return $this->redirectToRoute('admin_tricks_index');  
          
              return $this->redirectToRoute('admin_tricks_index');  
          
    }


 }
