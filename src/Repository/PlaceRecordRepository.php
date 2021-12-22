<?php

namespace App\Repository;

use App\Entity\PlaceRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlaceRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceRecord[]    findAll()
 * @method PlaceRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceRecord::class);
    }

    // /**
    //  * @return PlaceRecord[] Returns an array of PlaceRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlaceRecord
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
