<?php

namespace App\Repository;

use App\Entity\SubmitterStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubmitterStructure>
 *
 * @method SubmitterStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubmitterStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubmitterStructure[]    findAll()
 * @method SubmitterStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubmitterStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubmitterStructure::class);
    }

    public function save(SubmitterStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SubmitterStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SubmitterStructure[] Returns an array of SubmitterStructure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SubmitterStructure
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
