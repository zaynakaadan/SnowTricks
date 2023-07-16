<?php 

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Form\CategoriesFormType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
    
}
}