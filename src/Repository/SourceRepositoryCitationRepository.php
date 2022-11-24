<?php

namespace App\Repository;

use App\Entity\SourceRepositoryCitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SourceRepositoryCitation>
 *
 * @method SourceRepositoryCitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceRepositoryCitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceRepositoryCitation[]    findAll()
 * @method SourceRepositoryCitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceRepositoryCitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceRepositoryCitation::class);
    }

    public function save(SourceRepositoryCitation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SourceRepositoryCitation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SourceRepositoryCitation[] Returns an array of SourceRepositoryCitation objects
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

//    public function findOneBySomeField($value): ?SourceRepositoryCitation
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
