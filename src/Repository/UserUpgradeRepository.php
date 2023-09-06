<?php

namespace App\Repository;

use App\Entity\UserUpgrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserUpgrade>
 *
 * @method UserUpgrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserUpgrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserUpgrade[]    findAll()
 * @method UserUpgrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserUpgradeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserUpgrade::class);
    }

//    /**
//     * @return UserUpgrade[] Returns an array of UserUpgrade objects
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

//    public function findOneBySomeField($value): ?UserUpgrade
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
