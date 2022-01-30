<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\ProductsInShop;
use App\Entity\Status;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/environment", name="environment.")
 */
class EnvironmentController extends AbstractController
{
    /**
     * @Route("/status", name="status")
     */
    public function index(
        EntityManagerInterface $entityManager
    ): Response
    {
        $statusCart = new Status();
        $statusCart->setName('cart');

        $statusOrdered = new Status();
        $statusOrdered->setName('ordered');

        $statusCompleted = new Status();
        $statusCompleted->setName('completed');

        $statusWaitingForDelivery = new Status();
        $statusWaitingForDelivery->setName('waitingForDelivery');

        $entityManager->persist($statusCart);
        $entityManager->persist($statusOrdered);
        $entityManager->persist($statusCompleted);
        $entityManager->persist($statusWaitingForDelivery);
        $entityManager->flush();

        return new JsonResponse('true');
    }

    /**
     * @Route("/products", name="products")
     */
    public function products(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository
    ): Response
    {
        for ($i = 3; $i <=100; $i++) {
            $product = new Product();
            $product->setName("Produkt".$i);
            $category = $categoryRepository->find(rand(1, 5));
            $product->setCategory($category);

            $entityManager->persist($product);
        }
        $entityManager->flush();

        return new JsonResponse('true');
    }

    /**
     * @Route("/productsInShop", name="productsInShop")
     */
    public function productsInShop(
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        ShopRepository $shopRepository
    ): Response
    {
        for ($i = 3; $i <=100; $i++) {
            $product = new ProductsInShop();
            $prod = $productRepository->find($i);
            $price = rand(1,10);
            $shop = $shopRepository->find(1);
//            $product->setProducts()
            $product->setProducts($prod);
            $product->setShop($shop);
            $product->setPrice($price);
//            $product->setCategory($category);

            $entityManager->persist($product);
        }
        $entityManager->flush();

        return new JsonResponse('true');
    }
}
