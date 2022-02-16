<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=ProductsInShop::class, mappedBy="products")
     */
    private $productsInShops;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products_in_shop", "cart_items", "order_items_info"})
     */
    private $name;

    public function __construct()
    {
        $this->productsInShops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|ProductsInShop[]
     */
    public function getProductsInShops(): Collection
    {
        return $this->productsInShops;
    }

    public function addProductsInShop(ProductsInShop $productsInShop): self
    {
        if (!$this->productsInShops->contains($productsInShop)) {
            $this->productsInShops[] = $productsInShop;
            $productsInShop->setProducts($this);
        }

        return $this;
    }

    public function removeProductsInShop(ProductsInShop $productsInShop): self
    {
        if ($this->productsInShops->removeElement($productsInShop)) {
            // set the owning side to null (unless already changed)
            if ($productsInShop->getProducts() === $this) {
                $productsInShop->setProducts(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
