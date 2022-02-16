<?php

namespace App\Controller\Admin;

use App\Entity\ProductsInShop;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductsInShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductsInShop::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
