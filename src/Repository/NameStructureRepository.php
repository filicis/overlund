<?php

namespace App\Repository;

use App\Entity\NameStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NameStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method NameStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method NameStructure[]    findAll()
 * @method NameStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NameStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NameStructure::class);
    }

    // /**
    //  * @return NameStructure[] Returns an array of NameStructure objects
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
    public function findOneBySomeField($value): ?NameStructure
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
