<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    #[Route('/profil/edit', name: 'app_profil_edit')]
    public function edit(): Response
    {
        return $this->render('profil/edit.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/password', name: 'app_profil_edit_password')]
    public function editPassword(): Response
    {
        return $this->render('profil/edit_password.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification', name: 'app_profil_edit_notification')]
    public function editNotification(): Response
    {
        return $this->render('profil/edit_notification.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification/ajouter', name: 'app_profil_edit_notification_ajouter')]
    public function editNotificationAjouter(): Response
    {
        return $this->render('profil/edit_notification_ajouter.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification/supprimer', name: 'app_profil_edit_notification_supprimer')]
    public function editNotificationSupprimer(): Response
    {
        return $this->render('profil/edit_notification_supprimer.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification/modifier', name: 'app_profil_edit_notification_modifier')]
    public function editNotificationModifier(): Response
    {
        return $this->render('profil/edit_notification_modifier.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification/consulter', name: 'app_profil_edit_notification_consulter')]
    public function editNotificationConsulter(): Response
    {
        return $this->render('profil/edit_notification_consulter.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/profil/edit/notification/consulter/{id}', name: 'app_profil_edit_notification_consulter_id')]
    public function editNotificationConsulterId($id): Response
    {
        return $this->render('profil/edit_notification_consulter_id.html.twig', [
            'controller_name' => 'ProfilController',
            'id' => $id,
        ]);
    }
    #[Route('/profil/edit/notification/consulter/{id}/modifier', name: 'app_profil_edit_notification_consulter_id_modifier')]
    public function editNotificationConsulterIdModifier($id): Response
    {
        return $this->render('profil/edit_notification_consulter_id_modifier.html.twig', [
            'controller_name' => 'ProfilController',
            'id' => $id,
        ]);
    }
    #[Route('/profil/edit/notification/consulter/{id}/supprimer', name: 'app_profil_edit_notification_consulter_id_supprimer')]
    public function editNotificationConsulterIdSupprimer($id): Response
    {
        return $this->render('profil/edit_notification_consulter_id_supprimer.html.twig', [
            'controller_name' => 'ProfilController',
            'id' => $id,
        ]);
    }
    #[Route('/profil/edit/notification/consulter/{id}/ajouter', name: 'app_profil_edit_notification_consulter_id_ajouter')]
    public function editNotificationConsulterIdAjouter($id): Response
    {
        return $this->render('profil/edit_notification_consulter_id_ajouter.html.twig', [
            'controller_name' => 'ProfilController',
            'id' => $id,
        ]);
    }
}
