<?php

namespace App\Repository;

use App\Entity\PersonaleNameStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersonaleNameStructure>
 *
 * @method PersonaleNameStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaleNameStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaleNameStructure[]    findAll()
 * @method PersonaleNameStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaleNameStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaleNameStructure::class);
    }

    public function save(PersonaleNameStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PersonaleNameStructure $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PersonaleNameStructure[] Returns an array of PersonaleNameStructure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PersonaleNameStructure
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
