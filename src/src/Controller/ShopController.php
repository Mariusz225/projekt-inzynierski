<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\OrderRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\ShopRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Rest\Route("/shopController", name="shopController.")
 */
class ShopController extends AbstractController
{
    /**
     * @Rest\Get("/getProductsInShop/{id}")
     * @param int $id
     * @param ShopRepository $shopRepository
     * @param ProductsInShopRepository $productsInShopRepository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(
        int $id,
        ShopRepository $shopRepository,
        ProductsInShopRepository $productsInShopRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $shop = $shopRepository->findOneBy([
            'id' => $id
        ]);



//        var_dump($shop[0]['name']);
        $products = $shop->getProductsInShop();

        $data = $serializer->serialize($products, JsonEncoder::FORMAT, ['groups' => 'products_in_shop']);


//        var_dump(count($products));
//        return $this->json($products);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}