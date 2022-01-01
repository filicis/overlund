<?php

namespace App\Repository;

use App\Entity\Indi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Indi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indi[]    findAll()
 * @method Indi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Indi::class);
    }

    // /**
    //  * @return Indi[] Returns an array of Indi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indi
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
