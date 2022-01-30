<?php

namespace App\Entity;

use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cart_items", "order_items_info"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderItems")
     * @Groups({"cart_items"})
     */
    private $oneOrder;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsInShop::class, inversedBy="orderItems")
     * @Groups({"cart_items", "order_items_info"})
     */
    private $productShop;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cart_items", "order_items_info"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOneOrder(): ?Order
    {
        return $this->oneOrder;
    }

    public function setOneOrder(?Order $oneOrder): self
    {
        $this->oneOrder = $oneOrder;

        return $this;
    }

    public function getProductShop(): ?ProductsInShop
    {
        return $this->productShop;
    }

    public function setProductShop(?ProductsInShop $productShop): self
    {
        $this->productShop = $productShop;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
