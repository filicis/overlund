<?php

namespace App\Repository;

use App\Entity\SourceRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SourceRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceRecord[]    findAll()
 * @method SourceRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceRecord::class);
    }

    // /**
    //  * @return SourceRecord[] Returns an array of SourceRecord objects
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
    public function findOneBySomeField($value): ?SourceRecord
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
