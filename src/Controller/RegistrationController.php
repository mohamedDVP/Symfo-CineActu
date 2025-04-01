<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class RegistrationController extends AbstractController
{

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $em, PasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le mot de passe de l'utilisateur
            $password = $form->get('password')->getData();
            
            // Encoder le mot de passe avec PasswordHasherInterface
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            // Enregistrer l'utilisateur en base de données
            $em->persist($user);
            $em->flush();

            // Rediriger vers la page de connexion ou une autre page
            $this->addFlash('success', 'Inscription réussie!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
