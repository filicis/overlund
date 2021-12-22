<?php

namespace App\Repository;

use App\Entity\RecordSuperclass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecordSuperclass|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecordSuperclass|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecordSuperclass[]    findAll()
 * @method RecordSuperclass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordSuperclassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecordSuperclass::class);
    }

    // /**
    //  * @return RecordSuperclass[] Returns an array of RecordSuperclass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecordSuperclass
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     *
     *
     **/

    public function mlr()
    {
      return $this->createQueryBuilder('f')
        ->select('f.xref')
        ->where('f.xref REGEXP "\w\d*"')
        ->orderby('f.xref DESC')
        ->getQuery()
        ->getOneOrNullResult()
      ;

    }
}
