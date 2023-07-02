<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
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
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function verifyUser($token, JWTService $jwt): Response
    {
        //dd($jwt->isValid($token));
        dd($jwt->getpayload($token));
    }



}
