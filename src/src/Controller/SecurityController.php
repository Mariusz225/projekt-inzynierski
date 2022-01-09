<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Rest\Get ("/login", name="app_login")
     */
//    public function login(?User $user): Response
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);


//        if (null === $user) {
//            return $this->json([
//                'message' => 'missing credentials',
//            ], Response::HTTP_UNAUTHORIZED);
//        }
//
////        $token = ...; // somehow create an API token for $user
//        $token = 'ss';
//
//        return $this->json([
//            'user'  => $user->getUserIdentifier(),
//            'token' => $token,
//        ]);
    }

    /**
     * @Rest\Get ("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Rest\Post ("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $user = new User();
//        $form = $this->createForm(RegistrationFormType::class, $user);
//        $form->handleRequest($request);

        $postData = json_decode($request->getContent(), true);
        $email = $postData['email'];
        $password = $postData['password'];

        $user->setEmail($email);

        // encode the plain password
        $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                $user,
                $password
            )
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        // do anything else you need here, like send an email

        return $this->redirectToRoute('_profiler_home');

//        if ($form->isSubmitted() && $form->isValid()) {
//            // encode the plain password
//            $user->setPassword(
//                $userPasswordHasherInterface->hashPassword(
//                    $user,
//                    $form->get('plainPassword')->getData()
//                )
//            );
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//            // do anything else you need here, like send an email
//
//            return $this->redirectToRoute('_profiler_home');
//        }


//        return $this->render('registration/register.html.twig', [
//            'registrationForm' => $form->createView(),
//        ]);
    }
}
