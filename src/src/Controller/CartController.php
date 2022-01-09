<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Status;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\ShopRepository;
use App\Repository\StatusRepository;
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
 * @Rest\Route("/cartController", name="cartController.")
 */
class CartController extends AbstractController
{
    /**
     * @var Status|null
     */
    private ?Status $cartStatus;
    /**
     * @var mixed
     */
    private $cartId;

    public function __construct(
        SessionInterface $session,
        Security $security,
        ManagerRegistry $doctrine,
        StatusRepository $statusRepository
    )
    {
        $this->cartStatus = $statusRepository->findOneBy([
            'name' => 'cart'
        ]);

        $isSessionCart = $session->has('cart');
        if (!$security->getUser() && !$isSessionCart) {
            $cart = new Order();
            $cart->setStatus($this->cartStatus);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            $this->cartId = $session->set('cart', $cart->getId());
        } elseif (!$security->getUser() && $isSessionCart) {
            $this->cartId = $session->get('cart');
        }
        else {
            if ($security->getUser()->getOrders()) {
                $cart = new Order();
                $cart->setStatus($this->cartStatus);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($cart);
                $entityManager->flush();
            } else {
                $cart = $this->getUser()->getOrders();
            }
            $this->cartId = $session->set('cart', $cart->getId());
        }
    }

    /**
     * @Rest\Post("/updateCart")
     */
    public function updateCart(
        OrderRepository $orderRepository,
        StatusRepository $statusRepository,
        SerializerInterface $serializer,
        ShopRepository $shopRepository,
        Request $request,
        OrderItemRepository $orderItemRepository,
        ProductsInShopRepository $productsInShopRepository,
        SessionInterface $session
    ): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $postData = json_decode($request->getContent(), true);
        $productId = $postData['productId'];
        $quantity = $postData['quantity'];

        $cart = $orderRepository->findOneBy([
            'id' => $this->cartId,
            'status' => $this->cartStatus
        ]);

        $productInShop = $productsInShopRepository->find($productId);
        $price = $productInShop->getPrice();



//        if (!$cart->getShop()) {
//            $cart->setShop($productInShop->getShop());
//        } elseif ($cart->getShop() !== $productInShop->getShop()) {
//
//
//            $session->remove('cart');
////            $cart->setShop(null);
////            $em->persist($cart);
//            $em->remove($cart);
////            $em->remove($cart);
//            $em->flush();
//
//            $data = $serializer->serialize(array('message' => 'badViewedShop'), JsonEncoder::FORMAT);
//            return new JsonResponse($data, Response::HTTP_OK, [], true);
//        }

        $orderItem = $orderItemRepository->findOneBy([
            'oneOrder' => $cart,
            'productShop' => $productInShop
        ]);

        if ($quantity === 0) {
            $cart->removeOrderItem($orderItem);
            $em->remove($orderItem);
//            $em->persist($cart);
            $em->flush();

            if ($cart->getOrderItems()->isEmpty()) {
//                var_dump('sss');
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


//            $session->remove('cart');
////            $cart->setShop(null);
////            $em->persist($cart);
//            $em->remove($cart);
////            $em->remove($cart);
//            $em->flush();

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
        OrderRepository $orderRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $cart = $orderRepository->findOneBy([
            'id' => $this->cartId,
            'status' => $this->cartStatus
        ]);

        $cartItems = $cart->getOrderItems();


//        foreach ($cartItems as $cartItem) {
//            var_dump($cartItem->getId());
//        }
//        var_dump($this->cartStatus);


        $data = $serializer->serialize($cartItems, JsonEncoder::FORMAT, ['groups' => 'cart_items']);

//        var_dump($data);


        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
