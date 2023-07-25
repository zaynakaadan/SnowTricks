<?php

namespace App\Controller;

use App\Form\ResetPasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use App\Repository\UsersRepository;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
            ]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/oubli-pass", name="forgotten_password")
     */
    public function forgottenPassword(Request $request, UsersRepository $usersRepository, TokenGeneratorInterface $tokenGeneratorInterface, EntityManagerInterface $entityManagerInterface, SendMailService $mail): Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);

        // Récupère le contenu du formulaire
        $form->handleRequest($request);
            //dd($form);
        // Vérifier si le formulaire a été énvoyé et valide
        if($form->isSubmitted() && $form->isValid()){
            // Chercher l'utilisateur par son email
            $user = $usersRepository->findOneByEmail($form->get('email')->getData());

            //dd($user);

            // Vérifie si j'ai un utilisateur
            if($user){
                // Je génère un token de réinitialisation
                $token = $tokenGeneratorInterface->generateToken();
                    //dd($token);
                $user->setResetToken($token);
                $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();

                //Je génère un lien de réinitialisation du mot de passe
                $url =$this->generateUrl('reset_pass', ['token'=> $token], UrlGeneratorInterface::ABSOLUTE_URL);
                //dd($url);
                //Je crée les données du mail
                $context = compact('url', 'user');
                // Envoi du mail
                $mail->send(
                    'no-reply@snowtricks.fr',
                    $user->getEmail(),
                    'Réinitialisation de mot de passe',
                    'password_reset',
                    $context
                );
                $this->addFlash('success', 'Email envoyé avec succès');
                return $this->redirectToRoute('app_login');
            }
            // Pas de utilisateur $user est null
            $this->addFlash('danger', 'Un problème est survenu');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/reset_password_request.html.twig', ['requestPassForm' => $form->createView()]);
    }
/**
     * @Route("/oubli-pass/{token}", name="reset_pass")
     */public function resetPass(string $token, Request $request, UsersRepository $usersRepository, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface): Response
     {
        // Vérifie si j'ai ce token dans la bdd
        $user = $usersRepository->findOneByResetToken($token);
        if($user){
            // Si j'ai un user je dois crée un formulaire pour rentrer son mot de passe 
            $form = $this->createForm(ResetPasswordFormType::class);

            
            // Récupère le contenu du formulaire
            $form->handleRequest($request);

            // Vérifier si le formulaire a été énvoyé et valide
            if($form->isSubmitted() && $form->isValid()){
            // efface le token
            $user->setResetToken(null);
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('password')->getData()

                )
                );
                $entityManagerInterface->persist($user);
                $entityManagerInterface->flush();

                $this->addFlash('success', 'Mot de passe changé avec succès');
                return $this->redirectToRoute('app_login');
            }


            return $this->render('security/reset_password.html.twig', [
                'passForm' => $form->createView()
            ]);
        }
        $this->addFlash('danger', 'Jeton invalide');
        return $this->redirectToRoute('app_login');
     }

}
