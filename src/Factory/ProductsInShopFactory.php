<?php

namespace App\Factory;

use App\Entity\ProductsInShop;
use App\Repository\ProductsInShopRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ProductsInShop>
 *
 * @method static ProductsInShop|Proxy createOne(array $attributes = [])
 * @method static ProductsInShop[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductsInShop|Proxy find(object|array|mixed $criteria)
 * @method static ProductsInShop|Proxy findOrCreate(array $attributes)
 * @method static ProductsInShop|Proxy first(string $sortedField = 'id')
 * @method static ProductsInShop|Proxy last(string $sortedField = 'id')
 * @method static ProductsInShop|Proxy random(array $attributes = [])
 * @method static ProductsInShop|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductsInShop[]|Proxy[] all()
 * @method static ProductsInShop[]|Proxy[] findBy(array $attributes)
 * @method static ProductsInShop[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductsInShop[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductsInShopRepository|RepositoryProxy repository()
 * @method ProductsInShop|Proxy create(array|callable $attributes = [])
 */
final class ProductsInShopFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'price' => self::faker()->randomFloat(true, null, 15),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ProductsInShop $productsInShop): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductsInShop::class;
    }
}
