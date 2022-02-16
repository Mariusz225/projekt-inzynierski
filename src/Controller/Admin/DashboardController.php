<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\DateAvailability;
use App\Entity\Employee;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\ProductsInShop;
use App\Entity\Shop;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Project-shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Kategorie', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Daty dostaw', 'fas fa-list', DateAvailability::class);
        yield MenuItem::linkToCrud('Pracownicy', 'fas fa-list', Employee::class);
        yield MenuItem::linkToCrud('Zamówienia', 'fas fa-list', Order::class);
//        yield MenuItem::linkToCrud('Przedmioty w zamówieniu', 'fas fa-list', OrderItem::class);
        yield MenuItem::linkToCrud('Produkty', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Produkty w sklepie', 'fas fa-list', ProductsInShop::class);
        yield MenuItem::linkToCrud('Sklep', 'fas fa-list', Shop::class);
        yield MenuItem::linkToCrud('Lista sklepów', 'fas fa-list', Shop::class);
        yield MenuItem::linkToCrud('Użytkownicy', 'fas fa-list', User::class);

    }
}
