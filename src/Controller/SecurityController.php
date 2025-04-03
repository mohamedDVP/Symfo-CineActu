<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;  // Remarque : j'ai modifié cette ligne pour utiliser l'annotation correctement
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // Si l'utilisateur est déjà connecté, rediriger vers la page d'accueil (ou une autre page)
        if ($this->getUser()) {
            return $this->redirectToRoute('film_list'); // Redirection vers la page d'accueil ou la page de films après la connexion
        }

        // Création du formulaire de connexion
        $form = $this->createForm(LoginType::class);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Aucun besoin de gérer l'authentification manuellement ici, Symfony s'en charge déjà
        // Si l'utilisateur est authentifié, il sera redirigé automatiquement grâce au mécanisme de sécurité de Symfony

        // Récupérer les erreurs d'authentification et le dernier email saisi (si présent)
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,  // Affiche l'erreur d'authentification si elle existe
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): void
    {
        // Cette méthode ne sera jamais appelée directement, Symfony gère automatiquement la déconnexion.
        throw new \LogicException('Ce message ne devrait jamais être affiché.');
    }
}
