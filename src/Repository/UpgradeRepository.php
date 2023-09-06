<?php

namespace App\Repository;

use App\Entity\Upgrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Upgrade>
 *
 * @method Upgrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upgrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upgrade[]    findAll()
 * @method Upgrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpgradeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Upgrade::class);
    }

//    /**
//     * @return Upgrade[] Returns an array of Upgrade objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Upgrade
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
