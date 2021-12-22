<?php

namespace App\Repository;

use App\Entity\NoteRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NoteRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteRecord[]    findAll()
 * @method NoteRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NoteRecord::class);
    }

    // /**
    //  * @return NoteRecord[] Returns an array of NoteRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NoteRecord
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
