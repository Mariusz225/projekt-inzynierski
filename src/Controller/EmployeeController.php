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
use App\Repository\UserRepository;
use Carbon\Carbon;
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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Rest\Route("/employeeController", name="employeeController.")
 */
class EmployeeController extends AbstractController
{
//    private ?\App\Entity\Employee $employee;

    private ?\Symfony\Component\Security\Core\User\UserInterface $user;

    public function __construct(
        Security $security,
        UserRepository $userRepository
//        EmployeeRepository $employeeRepository
    )
    {
        $this->user = $userRepository->findOneBy([
            'email' => $security->getUser()->getUserIdentifier()
        ]);
//        $this->user = $security->getUser();
//        $this->employee = $employeeRepository->findOneBy([
//            'user' => $user
//        ]);
    }
    /**
     * @Rest\Get("/getEmployeeInfo")
     * @param ShopRepository $shopRepository
//     * @param ProductsInShopRepository $productsInShopRepository
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function index(
        ShopRepository $shopRepository,
//        ProductsInShopRepository $productsInShopRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $data = [
            'shopId' => $this->user->getShop()->getId(),
            'position' => $this->user->getPosition()->getName()
        ];

        $data = $serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get ("/getOrdersFromTheStore", name="getOrdersFromTheStore")
     */
    public function getOrdersFromTheStore(
        ShopRepository $shopRepository,
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $userHasAccess = false;

//        $shop = $shopRepository->find();
        $shop = $this->user->getShop();

        $position = $this->user->getPosition()->getName();

//        foreach ($roles as $role) {

//        }
        if ($position === 'Sklepikarz' && $this->user->getShop() === $shop) {
            $userHasAccess = true;
//                break;
        }

        if ($userHasAccess) {
//            $orders = $shop->getOrders()->filter(function (Order $order) {
//                return $order->getStatus()->getName() === 'ordered';
//            });

            $orders = $orderRepository->findBy([
                'status' => $statusRepository->findOneBy(['name' => 'ordered'])
            ], ['date' => 'asc']);



            $data = $serializer->serialize($orders, JsonEncoder::FORMAT, ['groups' => 'order_shopkeeper']);

            return new JsonResponse($data, Response::HTTP_OK, [], true);
        }
        return new JsonResponse('hasNotPermission');
    }

    /**
     * @Rest\Get ("/getDriverOrdersInShop", name="getDriverOrdersInShop")
     */
    public function getDriverOrdersInShop(
        ShopRepository $shopRepository,
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        //TODO role ?
//        $userHasAccess = false;

//        $shop = $shopRepository->find(1);

        $shop = $this->user->getShop();


//        if ($userHasAccess) {

        $isStartedDelivery = $orderRepository->findOneBy([
            'driver' => $this->user,
            'status' => $statusRepository->findOneBy(['name' => 'delivery']),
            'date' => Carbon::today()
        ]);


//        $driverHasStartedOrder =  $this->user->getOrders()->filter(function (Order $order) {
//            return $order->getStatus()->getName() === 'delivery';
//        });


        if($isStartedDelivery) {
//            dd($isStartedDelivery);


            $orders = $orderRepository->findBy([
                'driver' => $this->user,
                'date' => Carbon::today(),
                'status' => $statusRepository->findOneBy(['name' => 'delivery'])
            ]);
//            $orders = $shop->getOrders()->filter(function (Order $order) {
//                return $order->getStatus()->getName() === 'delivery';
//            });
        } else {
            $orders = $orderRepository->findBy([
                'date' => Carbon::today(),
                'status' => $statusRepository->findOneBy(['name' => 'waitingForDelivery'])
            ]);

//            dd($orders);
//            $orders = $shop->getOrders()->filter(function (Order $order) {
//                return $order->getStatus()->getName() === 'waitingForDelivery';
//            });
        }

//            $orders = $shop->getOrders()->filter(function (Order $order) {
//                return $order->getStatus()->getName() === 'waitingForDelivery';
//            });

        $data = $serializer->serialize($orders, JsonEncoder::FORMAT, ['groups' => 'order_shopkeeper']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
//        }
//        return new JsonResponse(false);
    }

//    /**
//     * @Rest\Get ("/getOrdersStatus", name="getOrdersStatus")
//     */
//    public function getOrdersStatus(
//    ): JsonResponse
//    {
//        $orders = $this->shopService->getOrders()->filter(function (Order $order) {
//            return $order->getStatus()->getName() === 'delivery';
//        });
//
//        if (!$orders->isEmpty()) {
//            return new JsonResponse('delivery');
//        } else {
//            return new JsonResponse('waitingForDelivery');
//        }
//    }

    /**
     * @Rest\Get ("/checkIfShopkeeperHasStartedOrder", name="checkIfShopkeeperHasStartedOrder")
     */
    public function checkIfShopkeeperHasStartedOrder(
        OrderRepository $orderRepository,
        StatusRepository $statusRepository
    ): JsonResponse
    {
//        $employeeHasStartedAnotherOrder = $this->user->getOrders();
        $employeeHasStartedAnotherOrder = $orderRepository->findOneBy([
            'picker' => $this->user,
            'status' => $statusRepository->findOneBy(['name' => 'completed'])
        ]);

        if ($employeeHasStartedAnotherOrder) {
            $order = $orderRepository->findOneBy([
                'picker' => $this->user,
                'status' => $statusRepository->findOneBy([
                    'name' => 'completed'
                ])
            ]);
            return new JsonResponse($order->getId());
        }

        return new JsonResponse(false);
    }

    /**
     * @Rest\Get ("/checkIfDriverHasStartedDelivery", name="checkIfDriverHasStartedDelivery")
     */
    public function checkIfDriverHasStartedDelivery(
        OrderRepository $orderRepository,
        StatusRepository $statusRepository
    ): JsonResponse
    {

        $employeeHasStartedDelivery = $this->user->getOrders()->filter(function (Order $order) {
            return (
                $order->getStatus()->getName() === 'delivery'
                && $order->getDriver() === $this->getUser()
            );
        });
//        dd($this->user->getUserIdentifier());
        $isStartedDelivery = $orderRepository->findOneBy([
            'driver' => $this->user,
            'date' => Carbon::today(),
            'status' => $statusRepository->findOneBy(['name' => 'delivery'])
        ]);

        if ($isStartedDelivery) {
            return new JsonResponse(true);
        }
        return new JsonResponse(false);


    }

    /**
     * @Rest\Get ("/getOrderProductsInfo/{id}", name="getOrderProdutsInfo")
     */
    public function getOrderProductsInfo(
        int $id,
        OrderRepository $orderRepository,
        ShopRepository $shopRepository,
        SerializerInterface $serializer,
        OrderItemRepository $orderItemRepository
    ): JsonResponse
    {

        if (!($this->user->getShop()->getId() === $orderRepository->find($id)->getShop()->getId())) {
            return new JsonResponse(false);
        }

        $orderInShop = $this->user->getShop()->getOrders()->filter(function (Order $order) use ($id) {
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

        $employeeHasStartedAnotherOrder = $this->user->getOrders()->filter(function (Order $order) use ($id) {
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
            $this->user->addOrder($order);

            $entityManager->persist($order);
            $entityManager->persist($this->user);
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

    /**
     * @Rest\Put ("/setOrderAsDelivery", name="setOrderAsDelivery")
     */
    public function setOrderAsDelivery(
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        EntityManagerInterface $entityManager,
        UserInterface $user
    ): JsonResponse
    {

        $status = $statusRepository->findOneBy([
            'name' => 'delivery'
        ]);

        $orders = $orderRepository->findBy([
            'status' => $statusRepository->findOneBy([
                'name' => 'waitingForDelivery'
            ]),
            'date' => Carbon::today(),
            'shop' => $this->user->getShop()
        ]);


        foreach ($orders as $order) {
            $order->setStatus($status);
            $order->setDriver($this->user);
//            $this->user->addOrder();
            $entityManager->persist($order);
        }

        $entityManager->flush();

        return new JsonResponse(true);
    }

    /**
     * @Rest\Get ("/setOrderAsDelivered/{id}", name="setOrderAsDelivered")
     */
    public function setOrderAsDelivered(
        int $id,
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        EntityManagerInterface $entityManager,
        UserInterface $user
    ): JsonResponse
    {

        $status = $statusRepository->findOneBy([
            'name' => 'delivered'
        ]);

        $order = $orderRepository->find($id);

        $order->setStatus($status);


        $entityManager->persist($order);

        $entityManager->flush();

        return new JsonResponse(true);
    }
}