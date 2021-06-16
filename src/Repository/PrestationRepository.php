<?php

namespace App\Repository;

use App\Entity\Prestation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prestation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestation[]    findAll()
 * @method Prestation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestation::class);
    }

  
    /**
     *
     * Cette fonction permet de récuperer tous les types de prestations sur la table PRESTATION avec comme condition
     * que l'enregistrement soit actif 
     * @return Array[] : retourne un tableau avec les types de prestations distincts 
     */
    public function findByAllTypePrestation()
    {
        return $this->createQueryBuilder('p')
            ->select('p.typePrestation')
            ->andWhere('p.isActive = 1')
            ->orderBy('p.typePrestation', 'ASC')
            ->distinct('p.typePrestation')
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    /**
     * @param $type : correspond au type de prestation présent dans le champ typePrestation
     * Cette fonction permet de récuperer toutes de prestations sur la table PRESTATION avec comme condition
     * que l'enregistrement soit actif et que le type de prestation correspond avec  celui placé en paramètre ($type)
     * @return Array[] : retourne un tableau avec les prestations pour le type en question 
     */
    public function findByAllPrestationParTypePrestation($type)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typePrestation = :val')
            ->andWhere ('p.isActive = 1')
            ->setParameter('val', $type)
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }
    
}
