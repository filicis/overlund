<?php

namespace App\Repository;

use App\Entity\EventStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventStructure[]    findAll()
 * @method EventStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventStructure::class);
    }

    // /**
    //  * @return EventStructure[] Returns an array of EventStructure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventStructure
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
