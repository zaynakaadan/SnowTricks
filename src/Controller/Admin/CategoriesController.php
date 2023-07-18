<?php 

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Tricks;
use App\Form\CategoriesFormType;
use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    /**
     * @Route("/admin/categories", name="admin_categories_")
     */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        $categories = $categoriesRepository->findBy([], ['name' => 'asc']);
        return $this->render('admin/categories/index.html.twig', compact('categories'));
    }
    /**
     * @Route("/ajout", name="add")
     */
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        try{
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        // Crée un nouveau category
        $category = new Categories();
        // Crée le formulaire
        $categoryForm = $this->createForm(CategoriesFormType::class, $category );

        // Traite la requete du formulaire
        $categoryForm->handleRequest($request);
        //dd($categoryForm);

        // Vérifie si le formulaire est soumis et valide
        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
        
        // Génère le slug (créé le slug)
        $slug = $slugger->slug($category->getName());
        //dd($slug);
        // stoker slug dans le trick
        $category->setSlug($slug);

        
        
            // Stoker les information dans bdd
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Categorie ajouté avec succès');

            // Redirige 
            return $this->redirectToRoute('admin_categories_index');

        }

        return $this->renderForm('admin/categories/add.html.twig', compact('categoryForm'));
    
    } catch (AccessDeniedException $e) {
        $this->addFlash('danger', 'Vous n\'êtes pas autorisé à ajouter la catégorie ');
        return $this->redirectToRoute('admin_categories_index');  
    }
} 
    /**
     * @Route("/edition/{id}", name="edit")
     */
    public function edit($id, Request $request, EntityManagerInterface $em, SluggerInterface $slugger,CategoriesRepository $categoriesRepository): Response
    {
        // Find the category by id
    $category = $categoriesRepository->find($id);

    // Check if the category exists
    if (!$category) {
        throw $this->createNotFoundException('Category not found');
    }
        // Vérifie si l'utilisateur peut éditer avec le Voter
       // $this->denyAccessUnlessGranted('TRICK_EDIT', $category);

        // Crée le formulaire
        $categoryForm = $this->createForm(CategoriesFormType::class, $category);

        // Traite la requete du formulaire
        $categoryForm->handleRequest($request);
                //dd($categoryForm);
        
        // Vérifie si le formulaire est soumis et valide
                if($categoryForm->isSubmitted() && $categoryForm->isValid()){
                    

                    // Génère le slug (créé le slug)
                    $slug = $slugger->slug($category->getName());
                    //dd($slug);
                    // stoker slug dans le category
                    $category->setSlug($slug);
        
                    $data = $categoryForm->getData();
                    // Attribuer l' utilisateur à la propriété de l'entité
                    //$data->setUser($this->getUser()); 
                
                    // Stoker les information dans bdd
                    $em->persist($data);
                    $em->flush();
        
                    $this->addFlash('success', 'Category modifié avec succès');
        
                    // Redirige 
                    return $this->redirectToRoute('admin_categories_index');        
                }
        
                return $this->render('admin/categories/edit.html.twig', [
                    'categoryForm'=> $categoryForm->createView(),
                    'category' => $category 
                ]);                    
            }  
    /**
     * @Route("/suppression/{id}", name="delete")
     */
    public function delete( $id, Categories $category, EntityManagerInterface $entityManager): Response
    {         
        // Obtenez les tricks associées à la catégorie
        $tricks = $category->getTricks();
        // Supprimer l'association de chaque trick avec la catégorie
        foreach ($tricks as $trick) {
        $trick->setCategory($id);
        }
                 
        // Supprimer le category entity
            $entityManager->remove($category);
            $entityManager->flush();
            $this->addFlash('success', 'Categorie à été supprimée ');
          
         return $this->redirectToRoute('admin_categories_index');         
    }  
}