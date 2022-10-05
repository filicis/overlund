<?php

namespace App\Repository;

use App\Entity\IdentifierLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IdentifierLink>
 *
 * @method IdentifierLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentifierLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentifierLink[]    findAll()
 * @method IdentifierLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifierLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentifierLink::class);
    }

    public function save(IdentifierLink $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IdentifierLink $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IdentifierLink[] Returns an array of IdentifierLink objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IdentifierLink
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
