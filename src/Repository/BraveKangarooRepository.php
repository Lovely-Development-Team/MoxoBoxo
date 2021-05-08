<?php

namespace App\Repository;

use App\Entity\BraveKangaroo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BraveKangaroo|null find($id, $lockMode = null, $lockVersion = null)
 * @method BraveKangaroo|null findOneBy(array $criteria, array $orderBy = null)
 * @method BraveKangaroo[]    findAll()
 * @method BraveKangaroo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BraveKangarooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BraveKangaroo::class);
    }

    // /**
    //  * @return BraveKangaroo[] Returns an array of BraveKangaroo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BraveKangaroo
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
