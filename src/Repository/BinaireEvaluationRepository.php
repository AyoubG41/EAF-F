<?php

namespace App\Repository;

use App\Entity\BinaireEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BinaireEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BinaireEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BinaireEvaluation[]    findAll()
 * @method BinaireEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BinaireEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BinaireEvaluation::class);
    }

    // /**
    //  * @return BinaireEvaluation[] Returns an array of BinaireEvaluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BinaireEvaluation
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
