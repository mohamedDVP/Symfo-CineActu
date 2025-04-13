<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Note;
use App\Form\NoteType;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Form\CommentaireNoteType;
use App\Repository\CommentaireRepository;
use App\Repository\FilmRepository;
use App\Repository\NoteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FilmController extends AbstractController
{
    #[Route('/films', name: 'app_films_liste')]
    public function index(FilmRepository $filmRepository, NoteRepository $noteRepository): Response
    {
        $films = $filmRepository->findAll();

        // On crée un tableau associatif [film => moyenne]
        $averageNotes = [];
        foreach ($films as $film) {
            $averageNotes[$film->getId()] = $noteRepository->getAverageNoteForFilm($film);
        }

        return $this->render('film/index.html.twig', [
            'films' => $films,
            'averageNotes' => $averageNotes,
        ]);
    }


    #[Route('/film/{id}', name: 'app_film_detail')]
    public function detail(
        int $id,
        FilmRepository $filmRepository,
        Request $request,
        EntityManagerInterface $em,
        NoteRepository $noteRepository,
        CommentaireRepository $commentaireRepo
    ): Response {
        $film = $em->getRepository(Film::class)->find($id);

        if (!$film) {
            throw $this->createNotFoundException('Film non trouvé');
        }

        $commentaires = $commentaireRepo->findApprovedByFilm($film);

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireNoteType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->getUser()) {
                $this->addFlash('error', 'Vous devez être connecté pour commenter.');
                return $this->redirectToRoute('app_login');
            }

            // Créer la note
            $noteValue = $form->get('note')->getData();
            $note = new Note();
            $note->setNoteValue($noteValue);
            $note->setFilm($film);
            $note->setUser($this->getUser());

            // Associer la note au commentaire
            $commentaire->setNote($note);
            $commentaire->setFilm($film);
            $commentaire->setUser($this->getUser());
            $commentaire->setCreatedAt(new \DateTimeImmutable());
            $commentaire->setApprouve(false); // En attente de validation admin

            $em->persist($note);
            $em->persist($commentaire);
            $em->flush();

            $this->addFlash('success', 'Votre commentaire a été soumis pour validation.');
            return $this->redirectToRoute('app_film_detail', ['id' => $film->getId()]);
        }

        return $this->render('film/detail.html.twig', [
            'film' => $film,
            'commentairesOK' => $commentaires,
            'commentaires' => $commentaire,
            'averageNote' => $noteRepository->getAverageNoteForFilm($film),
            'form' => $form->createView(),
        ]);
    }
}