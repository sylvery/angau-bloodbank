<?php

namespace App\Repository;

use App\Entity\Bloodbag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bloodbag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bloodbag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bloodbag[]    findAll()
 * @method Bloodbag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodbagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bloodbag::class);
    }

    // /**
    //  * @return Bloodbag[] Returns an array of Bloodbag objects
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
    public function findOneBySomeField($value): ?Bloodbag
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
