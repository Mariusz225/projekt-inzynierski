<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cart_items"})
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

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="shop")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Employee::class, mappedBy="shop")
     */
    private $employees;

    public function __construct()
    {
        $this->productsInShop = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->employees = new ArrayCollection();
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

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setShop($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getShop() === $this) {
                $order->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees[] = $employee;
            $employee->setShop($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getShop() === $this) {
                $employee->setShop(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
