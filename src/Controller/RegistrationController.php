<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RegistrationController extends AbstractController
{

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe
            $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);
            $user->setPassword($hashedPassword);

            // Enregistrer l'utilisateur
            $em->persist($user);
            $em->flush();

            // Rediriger après l'inscription
            $this->addFlash('success', 'Inscription réussie!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
