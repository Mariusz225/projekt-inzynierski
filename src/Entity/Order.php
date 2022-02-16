<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ({"order_shopkeeper", "order_items_info"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     * @Groups ({"order_shopkeeper", "order_info"})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="oneOrder")
     * @Groups ({"order_items_info"})
     */
    private $orderItems;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="orders")
     * @Groups({"cart_items"})
     */
    private $shop;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups ({"order_shopkeeper"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="driverOrders")
     */
    private $driver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"order_shopkeeper"})
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"order_shopkeeper"})
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"order_shopkeeper"})
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"order_shopkeeper"})
     */
    private $phoneNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="orders")
     */
    private $picker;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setOneOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getOneOrder() === $this) {
                $orderItem->setOneOrder(null);
            }
        }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDriver(): ?Employee
    {
        return $this->driver;
    }

    public function setDriver(?Employee $driver): self
    {
        $this->driver = $driver;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPicker(): ?Employee
    {
        return $this->picker;
    }

    public function setPicker(?Employee $picker): self
    {
        $this->picker = $picker;

        return $this;
    }
}
