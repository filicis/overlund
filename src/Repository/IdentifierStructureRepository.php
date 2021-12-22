<?php

namespace App\Repository;

use App\Entity\IdentifierStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdentifierStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentifierStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentifierStructure[]    findAll()
 * @method IdentifierStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifierStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentifierStructure::class);
    }

    // /**
    //  * @return IdentifierStructure[] Returns an array of IdentifierStructure objects
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
    public function findOneBySomeField($value): ?IdentifierStructure
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
