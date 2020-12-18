<?php

namespace App\Entity;

use App\Entity\Timestamps;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"product_read"}}
 *      },
 *      "post"
 *  },
 *  itemOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"product_details_read"}}
 *      },
 *      "put",
 *      "patch",
 *      "delete",
 *  }
 * )
 */
class Product
{
    use Timestamps;
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_details_read", "product_read", "product_details_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"user_details_read", "product_read", "product_details_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user_details_read", "product_read", "product_details_read"})
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user_details_read", "product_read", "product_details_read"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product_details_read"})
     */
    private $author;

    public function __construct()
    {
        $this->createdAt = new \DateTime("now");
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
