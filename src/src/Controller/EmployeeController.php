<?php

namespace App\Controller;


use App\Entity\Order;
use App\Entity\User;
use App\Repository\EmployeeRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\ShopRepository;
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
 * @Rest\Route("/employeeController", name="employeeController.")
 */
class EmployeeController extends AbstractController
{
    private array $employee;

    public function __construct(
        Security $security,
        EmployeeRepository $employeeRepository
    )
    {
        $user = $security->getUser();
        $this->employee = $employeeRepository->findBy([
            'user' => $user
        ]);
//        var_dump($employee->getId());
    }
    /**
     * @Rest\Get("/getEmployeeInfo")
     * @param ShopRepository $shopRepository
     * @param ProductsInShopRepository $productsInShopRepository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(
        ShopRepository $shopRepository,
        ProductsInShopRepository $productsInShopRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ): JsonResponse
    {
//        var_dump($this->employee);
//
//
////        $shop = $shopRepository->findOneBy([
////            'id' => $id
////        ]);
////        $products = $shop->getProductsInShop();
////
        $data = $serializer->serialize($this->employee, JsonEncoder::FORMAT, ['groups' => 'employee_info']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get ("/getOrdersFromTheStore/{id}", name="getOrdersFromTheStore")
     */
    public function getOrdersFromTheStore(
        int $id,
        ShopRepository $shopRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        //TODO role ?
        $userHasAccess = false;

        $shop = $shopRepository->find($id);

        foreach ($this->employee as $item) {
            $item->getShop($shopRepository->findOneBy(['id' => $id]));
            if ($item->getShop() === $shop) {
                $userHasAccess = true;
                break;
            }
        }
        if ($userHasAccess) {
            $orders = $shop->getOrders()->filter(function (Order $order) {
                return $order->getStatus()->getName() === 'ordered';
            });

            $data = $serializer->serialize($orders, JsonEncoder::FORMAT, ['groups' => 'order_shopkeeper']);

            return new JsonResponse($data, Response::HTTP_OK, [], true);
        }
//        foreach ($dupa as $xd) {
//            if ($xd === 'b') {
//                var_dump($xd);
//                break;
//            }
//        }
//        var_dump($dupa);
        return new JsonResponse(false);
    }
}