<?php

namespace App\Repository;

use App\Entity\AppEntityGedcomHead;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AppEntityGedcomHead|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppEntityGedcomHead|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppEntityGedcomHead[]    findAll()
 * @method AppEntityGedcomHead[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppEntityGedcomHeadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppEntityGedcomHead::class);
    }

    // /**
    //  * @return AppEntityGedcomHead[] Returns an array of AppEntityGedcomHead objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AppEntityGedcomHead
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
