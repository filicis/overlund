<?php

namespace App\Repository;

use App\Entity\FileReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FileReference>
 *
 * @method FileReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileReference[]    findAll()
 * @method FileReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileReference::class);
    }

    public function save(FileReference $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FileReference $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FileReference[] Returns an array of FileReference objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FileReference
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
