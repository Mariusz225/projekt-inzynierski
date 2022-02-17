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
     * @Groups ({"shop_info"})
     * @Groups({"cart_items"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="shop")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=DateAvailability::class, mappedBy="shop")
     */
    private $dateAvailabilities;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"shop_info"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"shop_info"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"shop_info"})
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="shop")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="shop")
     */
    private $users;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->dateAvailabilities = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|DateAvailability[]
     */
    public function getDateAvailabilities(): Collection
    {
        return $this->dateAvailabilities;
    }

    public function addDateAvailability(DateAvailability $dateAvailability): self
    {
        if (!$this->dateAvailabilities->contains($dateAvailability)) {
            $this->dateAvailabilities[] = $dateAvailability;
            $dateAvailability->setShop($this);
        }

        return $this;
    }

    public function removeDateAvailability(DateAvailability $dateAvailability): self
    {
        if ($this->dateAvailabilities->removeElement($dateAvailability)) {
            // set the owning side to null (unless already changed)
            if ($dateAvailability->getShop() === $this) {
                $dateAvailability->setShop(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setShop($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getShop() === $this) {
                $product->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setShop($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getShop() === $this) {
                $user->setShop(null);
            }
        }

        return $this;
    }
}
