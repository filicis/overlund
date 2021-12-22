<?php

namespace App\Repository;

use App\Entity\SubmitterRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubmitterRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubmitterRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubmitterRecord[]    findAll()
 * @method SubmitterRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubmitterRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubmitterRecord::class);
    }

    // /**
    //  * @return SubmitterRecord[] Returns an array of SubmitterRecord objects
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
    public function findOneBySomeField($value): ?SubmitterRecord
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
