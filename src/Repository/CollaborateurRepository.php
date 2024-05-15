<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Collaborateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Collaborateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collaborateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collaborateur[]    findAll()
 * @method Collaborateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Collaborateur>
 */
final class CollaborateurRepository extends ServiceEntityRepository
{
    /**
     * Fonction qui est le constructeur de la classe CollaborateurRepository.
     *
     * Cette fonction permet de contruire l'objet CollaborateurRepository en reprenant les fonctions de sa classe parent qui est ServiceEntityRepository
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collaborateur::class);
    }

    /**
     * Cette fonction permet de récuperer tous enregistrements actifs
     * return Collaborateur[] Returns an array of Collaborateur objects.
     */
    public function findByIsActif(): mixed
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActif = 1')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Fonction permettant de lister les collaborateurs qui se sont connectés par ordre décroissant
     * return Collaborateur[] Returns an array of Collaborateur objects.
     */
    public function findByDerniereConnexion(): mixed
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActif = 1')
            ->orderBy('c.dateHeureDerniereConnexion', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Collaborateur
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
