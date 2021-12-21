<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ProductsInShop::class, mappedBy="shop")
     */
    private $productsInShop;

    public function __construct()
    {
        $this->productsInShop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|ProductsInShop[]
     */
    public function getProductsInShop(): Collection
    {
        return $this->productsInShop;
    }

    public function addProductsInShop(ProductsInShop $productsInShop): self
    {
        if (!$this->productsInShop->contains($productsInShop)) {
            $this->productsInShop[] = $productsInShop;
            $productsInShop->setShop($this);
        }

        return $this;
    }

    public function removeProductsInShop(ProductsInShop $productsInShop): self
    {
        if ($this->productsInShop->removeElement($productsInShop)) {
            // set the owning side to null (unless already changed)
            if ($productsInShop->getShop() === $this) {
                $productsInShop->setShop(null);
            }
        }

        return $this;
    }
}
