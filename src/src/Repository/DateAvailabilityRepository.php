<?php

namespace App\Repository;

use App\Entity\DateAvailability;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateAvailability|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateAvailability|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateAvailability[]    findAll()
 * @method DateAvailability[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateAvailabilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateAvailability::class);
    }

    // /**
    //  * @return DateAvailability[] Returns an array of DateAvailability objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateAvailability
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
