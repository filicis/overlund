<?php

namespace App\Repository;

use App\Entity\SourceCitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SourceCitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceCitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceCitation[]    findAll()
 * @method SourceCitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceCitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceCitation::class);
    }

    // /**
    //  * @return SourceCitation[] Returns an array of SourceCitation objects
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
    public function findOneBySomeField($value): ?SourceCitation
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
