<?php

namespace App\Repository;

use App\Entity\Sicktype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sicktype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sicktype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sicktype[]    findAll()
 * @method Sicktype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SicktypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sicktype::class);
    }

    // /**
    //  * @return Sicktype[] Returns an array of Sicktype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sicktype
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
