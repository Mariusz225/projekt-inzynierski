<?php

namespace App\Controller;


use App\Entity\Category;
use App\Entity\DateAvailability;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\ShopRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\Annotations as Rest;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Rest\Get("/getProductsInShop/{id}/{categoryName}/{numberOfPagination}")
     * @param int $id
     * @param int $numberOfPagination
     * @param string $categoryName
     * @param CategoryRepository $categoryRepository
     * @param ShopRepository $shopRepository
     * @param ProductRepository $productRepository
     * @param PaginatorInterface $paginator
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(
        int $id,
        int $numberOfPagination,
        string $categoryName,
        CategoryRepository $categoryRepository,
        ShopRepository $shopRepository,
        ProductRepository $productRepository,
        PaginatorInterface $paginator,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ): JsonResponse
    {
        if ($categoryName === 'undefined') {
            $products = $productRepository->findBy([
                'shop' => $shopRepository->find($id),
            ]);
        } else {
//            $category = $categoryRepository->findOneBy([
//                'name' => $categoryName
//            ]);
//            $shop = $shopRepository->find($id);

//            $products = $productsInShopRepository->findProductsInShopByCategory($category, $shop);
            $products = $productRepository->findBy([
                'category' => $categoryRepository->findOneBy([
                    'name' => $categoryName
                ]),
                'shop' => $shopRepository->find($id)
            ]);

        }

        $pagination = $paginator->paginate(
            $products,
            $numberOfPagination,
            12
        );

        if ($pagination->count() === 0) {
            return new JsonResponse(false);
        }

        $data = $serializer->serialize($pagination, JsonEncoder::FORMAT, ['groups' => 'products_in_shop']);


//        var_dump(count($products));
//        return $this->json($products);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/getNumberOfProductsInShop/{id}")
     * @param int $id
     * @param ShopRepository $shopRepository
     * @param PaginatorInterface $paginator
//     * @param ProductsInShopRepository $productsInShopRepository
//     * @param SerializerInterface $serializer
//     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function getNumberOfProductsInShop(
        int $id,
        ShopRepository $shopRepository,
        PaginatorInterface $paginator
//        ProductsInShopRepository $productsInShopRepository,
//        SerializerInterface $serializer,
//        EntityManagerInterface $em
    ): JsonResponse
    {
//        if ($category === 'all') {
//        $products = $productsInShopRepository->findBy([
//            'shop' => $shopRepository->find($id),
//        ]);
        $shop = $shopRepository->find($id);
        $numberOfProducts = $shop->getProducts()->count();

        return new JsonResponse($numberOfProducts, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/getCategoriesInShop/{id}")
     * @param int $id
     * @param CategoryRepository $categoryRepository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function getCategoriesInShop(
        int $id,
        CategoryRepository $categoryRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $categories = $categoryRepository->findAll();


        $data = $serializer->serialize($categories, JsonEncoder::FORMAT, ['groups' => 'category']);


        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/getShopDatesAvailabilities")
     * @param ShopRepository $shopRepository
//     * @param ProductsInShopRepository $productsInShopRepository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param OrderRepository $orderRepository
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getShopDatesAvailabilities(
        ShopRepository $shopRepository,
//        ProductsInShopRepository $productsInShopRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        SessionInterface $session,
        OrderRepository $orderRepository,
        ProductRepository $productRepository
    ): JsonResponse
    {
//        $shop = $shopRepository->find($id);

        $isSessionCart = $session->has('cart');

        //TODO sprawdzić
        if ($isSessionCart) {
            $cartId = $session->get('cart');
        } else return new JsonResponse(false);

        $order = $orderRepository->find($cartId);

        $dateAvailabilities = $order->getShop()->getDateAvailabilities()->filter(function (DateAvailability $dateAvailability) {
                return $dateAvailability->getQuantity() > 0;
            });


        $data = $serializer->serialize($dateAvailabilities, JsonEncoder::FORMAT, ['groups' => 'shop_date_availability']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/getShops", name="getShops")
     * @param ShopRepository $shopRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getShops(
        ShopRepository $shopRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $shops = $shopRepository->findAll();

        $data = $serializer->serialize($shops, JsonEncoder::FORMAT, ['groups' => 'shop_info']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}