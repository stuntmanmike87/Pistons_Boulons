<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RendezVous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RendezVous|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVous|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVous[]    findAll()
 * @method RendezVous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class RendezVousRepository extends ServiceEntityRepository
{   
    /**
     * Fonction qui est le constructeur de la classe RendezVousRepository
     *
     * Cette fonction permet de contruire l'objet RendezVousRepository en reprenant les fonctions de sa classe parent qui est ServiceEntityRepository
     *
     * @param ManagerRegistry $registry 
     *
     * @return void
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVous::class);
    }

    /**
     * Cette Fonction permet de récupérer les rendez vous entre deux dates
     * @param \DateTime $debut 
     * @param \DateTime $fin
     * return RendezVous[] Returns an array of RendezVous objects
     */

    // SELECT * FROM RendezVous WHERE dateRendezVous BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND  '{$end->format('Y-m-d 23:59:59')}' 
    /** return array<string> */
    public function findAllByDateRendezVous(mixed $debut, mixed $fin): mixed
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.dateRendezVous BETWEEN :deb AND :fin')
            ->setParameter('deb', $debut)
            ->setParameter('fin', $fin)
            ->orderBy('r.dateRendezVous', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

   /**
     * Cette Fonction permet de récupérer les rendez vous entre deux dates
     * param DateTime $debut 
     * param DateTime $fin
     * return RendezVous[] Returns an array of RendezVous objects
     */

    // SELECT * FROM RendezVous WHERE dateRendezVous BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND  '{$end->format('Y-m-d 23:59:59')}' 
    /** return array<string> */
    public function findByDateRendezVous(mixed $jour): mixed
    {
        /** @var \DateTime $jour */
        return $this->createQueryBuilder('r')
            ->andWhere("r.dateRendezVous BETWEEN :deb AND :fin")
            ->setParameter('deb', $jour->format("Y-m-d 00:00:00"))
            ->setParameter('fin', $jour->format("Y-m-d 23:59:59"))
            ->orderBy('r.dateRendezVous', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?RendezVous
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
