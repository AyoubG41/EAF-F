<?php

namespace App\Repository;

use App\Entity\EAF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EAF|null find($id, $lockMode = null, $lockVersion = null)
 * @method EAF|null findOneBy(array $criteria, array $orderBy = null)
 * @method EAF[]    findAll()
 * @method EAF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EAFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EAF::class);
    }

    // /**
    //  * @return EAF[] Returns an array of EAF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EAF
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
