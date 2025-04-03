<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


final class RegistrationController extends AbstractController
{

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        $user->setRoles(['ROLE_USER']); // Par défaut, chaque utilisateur est un simple utilisateur

        // Si l'email est admin@example.com, on lui donne le rôle admin
        if ($user->getEmail() === 'admin@cineactu.com') {
            $user->setRoles(['ROLE_ADMIN']);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            // Sauvegarde en base de données
            $em->persist($user);
            $em->flush();

            // Redirection après l'inscription
            $this->addFlash('success', 'Inscription réussie!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
