<?php

namespace App\Repository;

use App\Entity\MediaRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MediaRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaRecord[]    findAll()
 * @method MediaRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaRecord::class);
    }

    // /**
    //  * @return MediaRecord[] Returns an array of MediaRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MediaRecord
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
