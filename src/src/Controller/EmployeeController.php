<?php

namespace App\Controller;


use App\Entity\Order;
use App\Entity\User;
use App\Repository\EmployeeRepository;
use App\Repository\OrderItemRepository;
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
 * @Rest\Route("/employeeController", name="employeeController.")
 */
class EmployeeController extends AbstractController
{
    private ?\App\Entity\Employee $employee;

    public function __construct(
        Security $security,
        EmployeeRepository $employeeRepository
    )
    {
        $user = $security->getUser();
        $this->employee = $employeeRepository->findOneBy([
            'user' => $user
        ]);
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
        $userHasAccess = false;

        $shop = $shopRepository->find($id);

        $roles = $this->employee->getRole();

        foreach ($roles as $role) {
            if ($role === 'ROLE_SHOPKEEPER' && $this->employee->getShop() === $shop) {
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
        return new JsonResponse('hasNotPermission');
    }

    /**
     * @Rest\Get ("/getDriverOrdersInShop/{id}", name="getDriverOrdersInShop")
     */
    public function getDriverOrdersInShop(
        int $id,
        ShopRepository $shopRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        //TODO role ?
        $userHasAccess = false;

        $shop = $shopRepository->find($id);

        if ($this->employee->getShop() === $shop) {
            $userHasAccess = true;
        }

        if ($userHasAccess) {
            $orders = $shop->getOrders()->filter(function (Order $order) {
                return $order->getStatus()->getName() === 'waitingForDelivery';
            });

            $data = $serializer->serialize($orders, JsonEncoder::FORMAT, ['groups' => 'order_shopkeeper']);

            return new JsonResponse($data, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(false);
    }

    /**
     * @Rest\Get ("/getOrdersStatus", name="getOrdersStatus")
     */
    public function getOrdersStatus(
    ): JsonResponse
    {
        $orders = $this->employee->getOrders()->filter(function (Order $order) {
            return $order->getStatus()->getName() === 'delivery';
        });

        if (!$orders->isEmpty()) {
            return new JsonResponse('delivery');
        } else {
            return new JsonResponse('waitingForDelivery');
        }
    }

    /**
     * @Rest\Get ("/checkIfShopkeeperHasStartedOrder", name="checkIfShopkeeperHasStartedOrder")
     */
    public function checkIfShopkeeperHasStartedOrder(
        OrderRepository $orderRepository,
        StatusRepository $statusRepository
    ): JsonResponse
    {

        $employeeHasStartedAnotherOrder = $this->employee->getOrders()->filter(function (Order $order) {
            return (
                $order->getStatus()->getName() === 'completed'
            );
        });

        if (!$employeeHasStartedAnotherOrder->isEmpty()) {
            $order = $orderRepository->findOneBy([
                'employee' => $this->employee,
                'status' => $statusRepository->findOneBy([
                    'name' => 'completed'
                ])
            ]);
            return new JsonResponse($order->getId());
        }



        return new JsonResponse(false);
    }

    /**
     * @Rest\Get ("/getOrderProductsInfo/{id}", name="getOrderProdutsInfo")
     */
    public function getOrderProductsInfo(
        int $id,
        OrderRepository $orderRepository,
        SerializerInterface $serializer,
        OrderItemRepository $orderItemRepository
    ): JsonResponse
    {
        $userHasNotPermissions = $orderRepository->findOneBy([
            'employee' => $this->employee,
            'id' => $id
        ]);

        // TODO if ($this->employee->getRole())

        $orderInShop = $this->employee->getShop()->getOrders()->filter(function (Order $order) use ($id) {
            return (
                $order->getId() === $id
            );
        });

        if ($orderInShop->isEmpty()) {
            return new JsonResponse(false);
        }


        $order = $orderRepository->find($id);

        $orderItems = $order->getOrderItems();


        $data = $serializer->serialize($orderItems, JsonEncoder::FORMAT, ['groups' => 'order_items_info']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get ("/setCompletingEmployee/{id}", name="setCompletingEmployee")
     */
    public function setCompletingEmployee(
        int $id,
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {

        $employeeHasStartedAnotherOrder = $this->employee->getOrders()->filter(function (Order $order) use ($id) {
            return (
                $order->getStatus()->getName() === 'completed'
                && $order->getId() !== $id
            );
        });


        if (!$employeeHasStartedAnotherOrder->isEmpty()) {
            return new JsonResponse('userHasStartedAnotherOrder');
        } else {
            $order = $orderRepository->find($id);
            $statusCompleted = $statusRepository->findOneBy([
                'name' => 'completed'
            ]);
            $order->setStatus($statusCompleted);
            $this->employee->addOrder($order);

            $entityManager->persist($order);
            $entityManager->persist($this->employee);
            $entityManager->flush();

            return new JsonResponse(true);
        }
    }



    /**
     * @Rest\Put ("/setOrderAsWaitingForDelivery/{id}", name="setOrderAsWaitingForDelivery")
     */
    public function setOrderAsWaitingForDelivery(
        int $id,
        OrderRepository $orderRepository,
        SerializerInterface $serializer,
        OrderItemRepository $orderItemRepository,
        StatusRepository $statusRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {

        $status = $statusRepository->findOneBy([
            'name' => 'waitingForDelivery'
        ]);

        $order = $orderRepository->find($id);
        $order->setStatus($status);
        $entityManager->persist($order);
        $entityManager->flush();

        return new JsonResponse(true);
    }
}