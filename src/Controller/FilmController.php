<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FilmController extends AbstractController
{
    #[Route('/films', name: 'app_films_liste')]
    public function index(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll(); // Récupère tous les films de la base

        return $this->render('film/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/film/{id}', name: 'app_film_detail')]
    public function detail(int $id, FilmRepository $filmRepository, Request $request, EntityManagerInterface $em): Response
    {
        $film = $filmRepository->find($id);

        if (!$film) {
            throw $this->createNotFoundException('Ce film n\'existe pas.');
        }

        // Créer une nouvelle note
        $note = new Note();
        $formNote = $this->createForm(NoteType::class, $note);
        $formNote->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($formNote->isSubmitted() && $formNote->isValid()) {
            // Vérification que l'utilisateur est bien connecté
            if ($this->getUser() === null) {
                $this->addFlash('error', 'Vous devez être connecté pour attribuer une note.');
                return $this->redirectToRoute('app_login');
            }

            $note->setFilm($film);
            $note->setUser($this->getUser());  // L'utilisateur connecté
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('film_detail', ['id' => $id]);
        }

        // Récupérer la note moyenne
        $averageNote = $film->getNotes()->count() > 0 ? array_sum(array_map(function ($note) {
            return $note->getNote();
        }, $film->getNotes()->toArray())) / $film->getNotes()->count() : 0;

        return $this->render('film/detail.html.twig', [
            'film' => $film,
            'commentaires' => $film->getCommentaires(),
            'formNote' => $formNote->createView(),
            'averageNote' => round($averageNote, 2),  // Note moyenne
        ]);
    }
}
