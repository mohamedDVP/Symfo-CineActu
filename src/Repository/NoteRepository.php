<?php

namespace App\Repository;

use App\Entity\Film;
use App\Entity\Note;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Note>
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function getAverageNoteForFilm(Film $film): ?float
    {
        $qb = $this->createQueryBuilder('n')
            ->select('AVG(n.noteValue)') // Calcule la moyenne des notes
            ->where('n.film = :film')
            ->setParameter('film', $film)
            ->getQuery();

        return $qb->getSingleScalarResult(); // Retourne la moyenne
    }

    //    public function findOneBySomeField($value): ?Note
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
