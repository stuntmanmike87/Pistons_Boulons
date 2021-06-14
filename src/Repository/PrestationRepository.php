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

    // // /**
    // //  * @return Prestation[] Returns an array of Prestation objects
    // //  */
    // /*
     // SELECT DISTINCT typePrestation  FROM Prestation WHERE  estActive = 1 ORDER BY typePrestation ASC

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
    
//SELECT * FROM Prestation WHERE typePrestation IN ('".$type."') AND estActive= 1
    
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
