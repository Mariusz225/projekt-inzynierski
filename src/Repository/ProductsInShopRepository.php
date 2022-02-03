<?php

namespace App\Repository;

use App\Entity\ProductsInShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
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

    public function findProductsInShopByCategory($category, $shop)
    {
        return $this->createQueryBuilder('products_in_shop')
            ->leftJoin('products_in_shop.products', 'products')
            ->leftJoin('products.category', 'category')
            ->leftJoin('products_in_shop.shop', 'shop')
            ->where('category = :category')
            ->andWhere('shop = :shop')
//            ->andWhere('orderl = :order')
//            ->orderBy('article.date', 'DESC')
            ->setParameters(new ArrayCollection(array(
                new Parameter('category', $category),
                new Parameter('shop', $shop)
            )))
            ->getQuery()
            ->getResult()
            ;
    }
}
