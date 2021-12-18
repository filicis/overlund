<?php

namespace App\Repository;

use App\Entity\RecordLinks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecordLinks|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecordLinks|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecordLinks[]    findAll()
 * @method RecordLinks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordLinksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecordLinks::class);
    }

    // /**
    //  * @return RecordLinks[] Returns an array of RecordLinks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecordLinks
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
