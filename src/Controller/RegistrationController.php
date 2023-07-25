<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use App\Security\UsersAuthenticator;
use App\Service\JWTService;
use App\Service\SendMailService;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,
    UserAuthenticatorInterface $userAuthenticator, UsersAuthenticator $authenticator,
    EntityManagerInterface $entityManager, SendMailService $mail, JWTService $jwt): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            //génère le JWT de l'utilisateur
            //crée le Header
            $header = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];

            //crée le payload
            $payload = [
                'user_id' => $user->getId()
            ];

            //génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));
            //dd($token);
            
            //j'envoie un mail
            $mail->send(
                'no-replay@monsite.com',
                $user->getEmail(),
                'Activation de votre compte sur le site snowtricks',
                'register',
                compact('user', 'token')
                
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verif/{token}", name="verify_user")
     */
    public function verifyUser($token, JWTService $jwt, UsersRepository $usersRepository, EntityManagerInterface $em): Response
    {
        //dd($jwt->isValid($token));
        //dd($jwt->getpayload($token));
        //dd($jwt->isExpired($token));
        //dd($jwt->check($token, $this->getParameter('app.jwtsecret')));

        //Vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, $this->getParameter('app.jwtsecret'))){
            // Récupère le payload
            $payload = $jwt->getPayload($token);
            // Récupère le user du token
            $user = $usersRepository->find($payload['user_id']);

            //Vérifie que l'utilisateur existe et n'a pas encore activé son compte
            if ($user && !$user->getIsVerified()){
                $user->setIsVerified(true);
                $em->flush($user);
                $this->addFlash('success', 'Utilisateur activé');
                    return $this->redirectToRoute('profile_index');
            }
        }   


        // Ici un problème se pose dans le token
        $this->addFlash('danger', 'Le token est invalide ou a expiré');
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/renvoiverif", name="resend_verif")
     */
    public function resendVerif(JWTService $jwt, SendMailService $mail, UsersRepository $usersRepository): Response
    {
        // Récupère l'user connecté
        $user = $this->getUser();
        // si je n'a pas de l'user connecté
        if(!$user){
            $this->addFlash('danger', 'Vous devez être connecté pour accéder à cette page');
            return $this->redirectToRoute('app_login');
        }

        // si l'utilisateur est déja vérifié 
        if($user->getIsVerified()) {
            $this->addFlash('warning', 'Cet utilisateur est déja activé');
            return $this->redirectToRoute('profile_index');
        }
         //génère le JWT de l'utilisateur
            //crée le Header
            $header = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];

            //crée le payload
            $payload = [
                'user_id' => $user->getId()
            ];

            //génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));
            //dd($token);
            
            //j'envoie un mail
            $mail->send(
                'no-replay@monsite.com',
                $user->getEmail(),
                'Activation de votre compte sur le site snowtricks',
                'register',
                compact('user', 'token')
                
            );
            $this->addFlash('success', 'Email de vérification envoyé');
            return $this->redirectToRoute('profile_index');


    } 


    

}
