<?php

namespace App\Repository;

use App\Entity\WorkerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkerType>
 *
 * @method WorkerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkerType[]    findAll()
 * @method WorkerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkerType::class);
    }

//    /**
//     * @return WorkerType[] Returns an array of WorkerType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WorkerType
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
