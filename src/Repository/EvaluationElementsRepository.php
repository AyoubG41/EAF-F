<?php

namespace App\Repository;

use App\Entity\EvaluationElements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EvaluationElements|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvaluationElements|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvaluationElements[]    findAll()
 * @method EvaluationElements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationElementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvaluationElements::class);
    }

    // /**
    //  * @return EvaluationElements[] Returns an array of EvaluationElements objects
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
    public function findOneBySomeField($value): ?EvaluationElements
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
