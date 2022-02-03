<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="employees")
     * @Groups({"employee_info"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="employees")
     * @Groups({"employee_info"})
     */
    private $shop;

    /**
     * @ORM\Column(type="json")
     * @Groups({"employee_info"})

     */
    private $role = [];

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="driver")
     */
    private $driverOrders;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="picker")
     */
    private $orders;

    public function __construct()
    {
        $this->driverOrders = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getDriverOrders(): Collection
    {
        return $this->driverOrders;
    }

    public function addDriverOrder(Order $driverOrder): self
    {
        if (!$this->driverOrders->contains($driverOrder)) {
            $this->driverOrders[] = $driverOrder;
            $driverOrder->setDriver($this);
        }

        return $this;
    }

    public function removeDriverOrder(Order $driverOrder): self
    {
        if ($this->driverOrders->removeElement($driverOrder)) {
            // set the owning side to null (unless already changed)
            if ($driverOrder->getDriver() === $this) {
                $driverOrder->setDriver(null);
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
            $order->setPicker($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getPicker() === $this) {
                $order->setPicker(null);
            }
        }

        return $this;
    }
}
