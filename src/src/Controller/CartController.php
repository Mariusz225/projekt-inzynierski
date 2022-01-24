<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\DateAvailabilityRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Rest\Route("/cartController", name="cartController.")
 */
class CartController extends AbstractController
{
    private Order $cart;

    public function __construct(
        SessionInterface $session,
        ManagerRegistry $doctrine,
        StatusRepository $statusRepository,
        OrderRepository $orderRepository
    )
    {
        $cartStatus = $statusRepository->findOneBy([
            'name' => 'cart'
        ]);

        $isSessionCart = $session->has('cart');


        if (!$isSessionCart) {
            $cart = new Order();
            $this->cart = $cart;
            $cart->setStatus($cartStatus);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            $session->set('cart', $cart->getId());
        } else {
            $cartId = $session->get('cart');
            $cart = $orderRepository->find($cartId);
        }

        $this->cart = $cart;
    }

    /**
     * @Rest\Post("/updateCart")
     */
    public function updateCart(
        SerializerInterface $serializer,
        Request $request,
        OrderItemRepository $orderItemRepository,
        ProductsInShopRepository $productsInShopRepository
    ): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $postData = json_decode($request->getContent(), true);
        $productId = $postData['productId'];
        $quantity = $postData['quantity'];

        $cart = $this->cart;

        $productInShop = $productsInShopRepository->find($productId);
        $price = $productInShop->getPrice();

        $orderItem = $orderItemRepository->findOneBy([
            'oneOrder' => $cart,
            'productShop' => $productInShop
        ]);

        if ($quantity === 0) {
            $cart->removeOrderItem($orderItem);
            $em->remove($orderItem);
            $em->flush();

            if ($cart->getOrderItems()->isEmpty()) {
                $cart->setShop(null);
                $em->persist($cart);
                $em->flush();
                $data = $serializer->serialize(array('message' => 'cartIsEmpty'), JsonEncoder::FORMAT);
                return new JsonResponse($data, Response::HTTP_OK, [], true);
            }

            return new JsonResponse('true', Response::HTTP_OK, [], true);
        }

        if (!$cart->getShop()) {
            $cart->setShop($productInShop->getShop());
        } elseif ($cart->getShop() !== $productInShop->getShop()) {
            $data = $serializer->serialize(array('message' => 'badViewedShop'), JsonEncoder::FORMAT);
            return new JsonResponse($data, Response::HTTP_OK, [], true);
        }

        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->setOneOrder($cart);
            $orderItem->setQuantity($quantity);
            $orderItem->setProductShop($productInShop);
            $orderItem->setPrice($price);
            $cart->addOrderItem($orderItem);
            $cart->setShop($cart->getShop());
        } else {
            $orderItem->setQuantity($quantity);
        }

        $em->persist($cart);
        $em->persist($orderItem);
        $em->flush();

        return new JsonResponse('true', Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/downloadCart")
     */
    public function downloadCart(
        SerializerInterface $serializer
    ): JsonResponse
    {
        $cart = $this->cart;

        if ($cart->getOrderItems()->isEmpty()) {
            return new JsonResponse('empty');
        }

        $cartItems = $cart->getOrderItems();

        $data = $serializer->serialize($cartItems, JsonEncoder::FORMAT, ['groups' => 'cart_items']);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\POST("/submitOrder", name="submitOrder")
     * @throws Exception
     */
    public function submitOrder(
        Request $request,
        DateAvailabilityRepository $dateAvailabilityRepository,
        EntityManagerInterface $entityManager,
        StatusRepository $statusRepository
    ): JsonResponse
    {
        $cart = $this->cart;

        $postData = json_decode($request->getContent(), true);
        $shippingAddressInputs = $postData['shippingAddressInputs'];
        $deliveryDateId = $postData['deliveryDateId'];

        $cart->setName($shippingAddressInputs['name']);
        $cart->setSurname($shippingAddressInputs['surname']);
        $cart->setStreet($shippingAddressInputs['address']);
        $cart->setPostcode($shippingAddressInputs['postcode']);
        $cart->setTown($shippingAddressInputs['town']);
        $cart->setEmail($shippingAddressInputs['email']);
        $cart->setPhoneNumber($shippingAddressInputs['phoneNumber']);

        $date = $dateAvailabilityRepository->find($deliveryDateId);

        $statusOrdered = $statusRepository->findOneBy([
            'name' => 'ordered'
        ]);

        $cart->setDate($date->getDate());
        $cart->setStatus($statusOrdered);

        $entityManager->persist($cart);
        $entityManager->flush();

        return new JsonResponse('true', Response::HTTP_OK, [], true);
    }

    /**
     * @Rest\Get("/removeShopFromCart")
     */
    public function removeShopFromCart(
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $cart = $this->cart;

        $cart->setShop(null);
        $orderItems = $cart->getOrderItems();

        foreach ($orderItems as $orderItem) {
            $entityManager->remove($orderItem);
        }

        $entityManager->persist($cart);
        $entityManager->flush();

        return new JsonResponse(true);
    }
}
