<?php

namespace App\Repository;

use App\Entity\Sceance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sceance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sceance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sceance[]    findAll()
 * @method Sceance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SceanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sceance::class);
    }

    // /**
    //  * @return Sceance[] Returns an array of Sceance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sceance
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
