<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Content>
 */
final class ContentRepository extends ServiceEntityRepository
{
    /**
     * Fonction qui est le constructeur de la classe ContentRepository.
     *
     * Cette fonction permet de contruire l'objet ContentRepository en reprenant les fonctions de sa classe parent qui est ServiceEntityRepository
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    /**
     * param $value : correspond au champs Position de la table CONTENT.
     *
     * Cette fonction permet de récuperer tous les enregistrements sur la table CONTENT avec comme condition
     * que la position de l'enregistrement correspond (LIKE) au paramètre placé en entrée.
     * (on trie par ordre croissant sur l'id)
     * return Array[] : correspond au tableau des enregistrements
     * de type Content trouvé en fonction du param $value
     *
     * return array<string>
     */
    public function findByPosition(mixed $value): mixed
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.position LIKE :val')
            ->setParameter('val', $value.'%')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * param $value : correspond au champs Position de la table CONTENT.
     *
     * Cette fonction permet de récuperer l'enregistrement sur la table CONTENT avec comme condition
     * que la position de l'enregistrement est équivalente au paramètre placé en entrée
     * return Array[] : correspond au tableau de l'enregistrement avec comme position $value
     *
     * return array<string>
     */
    public function findOneByPosition(mixed $value): mixed
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.position = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
