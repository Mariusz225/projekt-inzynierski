<?php

namespace App\Repository;

use App\Entity\ProductsInShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductsInShop|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductsInShop|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductsInShop[]    findAll()
 * @method ProductsInShop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsInShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductsInShop::class);
    }

    // /**
    //  * @return ProductsInShop[] Returns an array of ProductsInShop objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductsInShop
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
