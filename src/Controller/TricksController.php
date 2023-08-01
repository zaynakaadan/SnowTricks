<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\MyTrait\CreatedAtTrait;
use App\Entity\Tricks;
use App\Entity\Users;
use App\Form\CommentsFormType;
use App\Repository\CommentsRepository;
use App\Repository\TricksRepository;


use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\DateTimeImmutable;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CategoriesRepository;
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
    public function comment(Request $request, TricksRepository $tricksRepository) {
        $commentText= $request->get('comment');
        // save the comment
    }

    /**
     * @Route("/comment/{id}", name="editcomment", methods={"PUT", "POST"})
     */
    public function editcomment(Request $request, TricksRepository $tricksRepository) {
        $commentText= $request->get('comment');
        // save the comment
    }

     /**
     * @Route("/comment/{id}", name="deletecomment", methods={"DELETE"})
     */
    public function deletecomment(Request $request, TricksRepository $tricksRepository) {
        $commentText= $request->get('comment');
        // save the comment
    }


 }
