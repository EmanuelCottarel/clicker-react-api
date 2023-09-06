<?php

namespace App\Repository;

use App\Entity\EffectType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EffectType>
 *
 * @method EffectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EffectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EffectType[]    findAll()
 * @method EffectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EffectTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EffectType::class);
    }

//    /**
//     * @return EffectType[] Returns an array of EffectType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EffectType
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
