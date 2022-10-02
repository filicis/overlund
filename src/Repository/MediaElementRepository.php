<?php

namespace App\Repository;

use App\Entity\MediaElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MediaElement>
 *
 * @method MediaElement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaElement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaElement[]    findAll()
 * @method MediaElement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaElementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaElement::class);
    }

    public function save(MediaElement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MediaElement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MediaElement[] Returns an array of MediaElement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MediaElement
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
