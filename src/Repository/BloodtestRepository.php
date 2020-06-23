<?php

namespace App\Repository;

use App\Entity\Bloodtest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bloodtest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bloodtest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bloodtest[]    findAll()
 * @method Bloodtest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BloodtestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bloodtest::class);
    }

    // /**
    //  * @return Bloodtest[] Returns an array of Bloodtest objects
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
    public function findOneBySomeField($value): ?Bloodtest
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
