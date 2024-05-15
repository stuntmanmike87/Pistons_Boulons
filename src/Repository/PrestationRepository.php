<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Prestation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestation[]    findAll()
 * @method Prestation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Prestation>
 */
final class PrestationRepository extends ServiceEntityRepository
{
    /**
     * Fonction qui est le constructeur de la classe PrestationRepository.
     *
     * Cette fonction permet de contruire l'objet PrestationRepository en reprenant les fonctions de sa classe parent qui est ServiceEntityRepository
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestation::class);
    }

    /**
     * Cette fonction permet de récuperer tous enregistrements actifs
     * return Content[] Returns an array of Collaborateur objects.
     *
     * return array<mixed>
     */
    public function findByIsActif(): mixed
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.isActive = 1')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Cette fonction permet de récuperer tous les types de prestations sur la table PRESTATION avec comme condition
     * que l'enregistrement soit actif.
     *
     * return Array[] : retourne un tableau avec les types de prestations distincts
     *
     * return array<string>
     */
    public function findByAllTypePrestation(): mixed
    {
        return $this->createQueryBuilder('p')
            ->select('p.typePrestation')
            ->andWhere('p.isActive = 1')
            ->orderBy('p.typePrestation', 'ASC')
            ->distinct(true)
            ->getQuery()
            ->getResult();
    }

    /**
     * param $type : correspond au type de prestation présent dans le champ typePrestation.
     *
     * Cette fonction permet de récuperer toutes de prestations sur la table PRESTATION avec comme condition
     * que l'enregistrement soit actif et que le type de prestation correspond avec  celui placé en paramètre ($type)
     *
     * return Array[] : retourne un tableau avec les prestations pour le type en question
     *
     * return array<string>
     */
    public function findByAllPrestationParTypePrestation(mixed $type): mixed
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typePrestation = :val')
            ->andWhere('p.isActive = 1')
            ->setParameter('val', $type)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
}
