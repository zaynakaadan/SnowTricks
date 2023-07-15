<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Tricks;
use App\Form\TricksFormType;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // Crée un nouveau trick
        $trick = new Tricks();

        // Crée le formulaire
        $trickForm = $this->createForm(TricksFormType::class, $trick );

        // Traite la requete du formulaire
        $trickForm->handleRequest($request);
        //dd($trickForm);

        // Vérifie si le formulaire est soumis et valide
        if($trickForm->isSubmitted() && $trickForm->isValid()){

            // Récupere les images
            $images = $trickForm->get('images')->getData();
            //dd($images);
            foreach($images as $image){
                // Définir le dossier de destination
                $folder = 'tricks';

                // Appeller le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Images();
                $img->setName($fichier);
                $trick->addImage($img);

            }

            // Génère le slug (créé le slug)
            $slug = $slugger->slug($trick->getName());
            //dd($slug);
            // stoker slug dans le trick
            $trick->setSlug($slug);

            $data = $trickForm->getData();
            // Attribuer l' utilisateur à la propriété de l'entité
            $data->setUser($this->getUser()); 
        
            // Stoker les information dans bdd
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'Trick ajouté avec succès');

            // Redirige 
            return $this->redirectToRoute('admin_tricks_index');

        }

        return $this->renderForm('admin/tricks/add.html.twig', compact('trickForm'));
    }
    /**
     * @Route("/edition/{id}", name="edit")
     */
    public function edit(Tricks $trick, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, PictureService $pictureService): Response
    {
        // Vérifie si l'utilisateur peut éditer avec le Voter
        $this->denyAccessUnlessGranted('TRICK_EDIT', $trick);

                // Crée le formulaire
                $trickForm = $this->createForm(TricksFormType::class, $trick );

                // Traite la requete du formulaire
                $trickForm->handleRequest($request);
                //dd($trickForm);
        
                // Vérifie si le formulaire est soumis et valide
                if($trickForm->isSubmitted() && $trickForm->isValid()){
                    // Récupere les images
                    $images = $trickForm->get('images')->getData();
                    //dd($images);
                    foreach($images as $image){
                    // Définir le dossier de destination
                    $folder = 'tricks';

                    // Appeller le service d'ajout
                    $fichier = $pictureService->add($image, $folder, 300, 300);

                    $img = new Images();
                    $img->setName($fichier);
                    $trick->addImage($img);

            }

                    // Génère le slug (créé le slug)
                    $slug = $slugger->slug($trick->getName());
                    //dd($slug);
                    // stoker slug dans le trick
                    $trick->setSlug($slug);
        
                    $data = $trickForm->getData();
                    // Attribuer l' utilisateur à la propriété de l'entité
                    $data->setUser($this->getUser()); 
                
                    // Stoker les information dans bdd
                    $em->persist($data);
                    $em->flush();
        
                    $this->addFlash('success', 'Trick modifié avec succès');
        
                    // Redirige 
                    return $this->redirectToRoute('admin_tricks_index');        
                }
        
                return $this->render('admin/tricks/edit.html.twig', [
                    'trickForm'=> $trickForm->createView(),
                    'trick' => $trick 
                ]);                    
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
/**
     * @Route("/suppression/image/{id}", name="delete_image", methods={"DELETE"})
     */
    public function deleteImage(Images $image, Request $request, EntityManagerInterface $em, PictureService $pictureService): JsonResponse
    {
       // Récupère le contenu de la requete
        $data = json_decode($request->getContent(), true);
       // Vérifier si le token est valide 
       if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'] )){
            // Le token csrf est valide
            // Récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'tricks', 300, 300)){
                // Supprime l'image de la base de données
                $em->remove($image);
                $em->flush();

                return new JsonResponse(['success' => true], 200);

            }
            // La suppression à échoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);

       }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }

}
