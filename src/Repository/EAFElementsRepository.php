<?php

namespace App\Repository;

use App\Entity\EAFElements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EAFElements|null find($id, $lockMode = null, $lockVersion = null)
 * @method EAFElements|null findOneBy(array $criteria, array $orderBy = null)
 * @method EAFElements[]    findAll()
 * @method EAFElements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EAFElementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EAFElements::class);
    }

    // /**
    //  * @return EAFElements[] Returns an array of EAFElements objects
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
    public function findOneBySomeField($value): ?EAFElements
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
