<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;
use App\Factory\ProductsInShopFactory;
use App\Factory\ShopFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $user = new User();
//        $user->setName('admin');

//        $user->setPassword($password);

//        $manager->persist($user);

//        CategoryFactory::createMany(5);
////        ShopFactory::createMany(3);
//
//        ShopFactory::createMany(3, [
//            'productsInShop' => ProductsInShopFactory::new([
//                'products' => ProductFactory::new([
////                    'category' => CategoryFactory::random()
//                    function() { // note the callback - this ensures that each of the 5 comments has a different Post
//                        return ['category' => CategoryFactory::random()]; // each comment set to a random Post from those already in the database
//                    }
//                ])
//            ])->many(150)
//        ]);


        $manager->flush();
    }
}
