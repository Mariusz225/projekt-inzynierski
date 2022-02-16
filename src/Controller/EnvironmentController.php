<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Employee;
use App\Entity\EmployeeRole;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\ProductsInShop;
use App\Entity\Shop;
use App\Entity\Status;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\EmployeeRepository;
use App\Repository\EmployeeRoleRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductsInShopRepository;
use App\Repository\ShopRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
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
     * @Route("/", name="")
     */
    public function index(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        ShopRepository $shopRepository,
        StatusRepository $statusRepository,
        UserRepository $userRepository,
        EmployeeRepository $employeeRepository,
        EmployeeRoleRepository $employeeRoleRepository,
        ProductsInShopRepository $productsInShopRepository,
        OrderItemRepository $orderItemRepository,
        OrderRepository $orderRepository
    ): Response
    {
        //USER
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword('$2y$13$9JHyLRf/XgtnQGeF1RhTsumARvc6Ix9rqqP9WV7iBmSUDE7pvIRb2');
        $user->setRoles(['ROLE_ADMIN']);
        $entityManager->persist($user);

        $user = new User();
        $user->setEmail('driver@driver.com');
        $user->setPassword('$2y$13$9JHyLRf/XgtnQGeF1RhTsumARvc6Ix9rqqP9WV7iBmSUDE7pvIRb2');
        $user->setRoles(['ROLE_EMPLOYEE']);
        $entityManager->persist($user);

        $user = new User();
        $user->setEmail('shopkeeper1@shopkeeper.com');
        $user->setPassword('$2y$13$9JHyLRf/XgtnQGeF1RhTsumARvc6Ix9rqqP9WV7iBmSUDE7pvIRb2');
        $user->setRoles(['ROLE_EMPLOYEE']);
        $entityManager->persist($user);

        $user = new User();
        $user->setEmail('shopkeeper2@shopkeeper.com');
        $user->setPassword('$2y$13$9JHyLRf/XgtnQGeF1RhTsumARvc6Ix9rqqP9WV7iBmSUDE7pvIRb2');
        $user->setRoles(['ROLE_EMPLOYEE']);
        $entityManager->persist($user);

        $entityManager->flush();




        //SHOP
        $shop = new Shop();
        $shop->setName('Sklep 1');
        $shop->setLongitude('54.464401');
        $shop->setLatitude('17.019279');
        $shop->setAddress('Słupsk, Wileńska 21');
        $entityManager->persist($shop);
        $shop = new Shop();
        $shop->setName('Sklep 2');
        $shop->setLongitude('54.469588');
        $shop->setLatitude('17.033098');
        $shop->setAddress('Słupsk, Kilińskiego 14');
        $entityManager->persist($shop);
        $entityManager->flush();






        //EMPLOYEE ROLE
        $employeeRole = new EmployeeRole();
        $employeeRole->setName('Kierowca');
        $entityManager->persist($employeeRole);

        $employeeRole = new EmployeeRole();
        $employeeRole->setName('Sprzedawca');
        $entityManager->persist($employeeRole);
        $entityManager->flush();






        //EMPLOYEE
        $employee = new Employee();
        $employee->setShop($shopRepository->find(1));
        $employee->setUser($userRepository->find(2));
        $employee->setEmployeeRole($employeeRoleRepository->find(1));
        $entityManager->persist($employee);

        $employee = new Employee();
        $employee->setShop($shopRepository->find(1));
        $employee->setUser($userRepository->find(3));
        $employee->setEmployeeRole($employeeRoleRepository->find(2));
        $entityManager->persist($employee);

        $employee = new Employee();
        $employee->setShop($shopRepository->find(1));
        $employee->setUser($userRepository->find(4));
        $employee->setEmployeeRole($employeeRoleRepository->find(2));
        $entityManager->persist($employee);





        //CATEGORY
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName("Kategoria " . $i);
            $entityManager->persist($category);
        }
        $entityManager->flush();





        //PRODUCT
        for ($i = 1; $i <= 100; $i++) {
            $product = new Product();
            $product->setName("Produkt".$i);
            $product->setCategory($categoryRepository->find(rand(1,5)));

            $entityManager->persist($product);
        }
        $entityManager->flush();






        //PRODUCT IN SHOP
        for ($i = 1; $i <=100; $i++) {
            $product = new ProductsInShop();
            $product->setProducts($productRepository->find($i));
            $product->setShop($shopRepository->find(1));
            $product->setPrice(rand(1,10));
            $entityManager->persist($product);
        }
        $entityManager->flush();
        for ($i = 1; $i <=100; $i++) {
            $product = new ProductsInShop();
            $product->setProducts($productRepository->find($i));
            $product->setShop($shopRepository->find(2));
            $product->setPrice(rand(1,10));
            $entityManager->persist($product);
        }
        $entityManager->flush();






        //STATUS
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











        //ORDER
        for ($i = 1; $i <= 5; $i++) {
            $order = new Order();
            $order->setDate(new \DateTime());
            $order->setName('Imię' . $i);
            $order->setSurname('Nazwisko' . $i);
            $order->setStreet('Ulica' . $i);
            $order->setPostcode('76-200');
            $order->setTown('Słupsk');
            $order->setShop($shopRepository->find(1));
            $order->setStatus($statusRepository->find(2));
            $order->setEmail('email@email.com');
            $order->setPhoneNumber('123456789');
            $entityManager->persist($order);
        }
        $entityManager->flush();

        for ($i = 1; $i <= 5; $i++) {
            $order = new Order();
            $order->setDate(new \DateTime());
            $order->setName('Imię' . $i);
            $order->setSurname('Nazwisko' . $i);
            $order->setStreet('Ulica' . $i);
            $order->setPostcode('76-200');
            $order->setTown('Słupsk');
            $order->setShop($shopRepository->find(1));
            $order->setPicker($employeeRepository->find(2));
            $order->setStatus($statusRepository->find(4));
            $order->setEmail('email@email.com');
            $order->setPhoneNumber('123456789');
            $entityManager->persist($order);
        }
        $entityManager->flush();







        return new JsonResponse('true');
    }
}
