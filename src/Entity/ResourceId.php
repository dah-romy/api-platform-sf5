<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait ResourceId
{
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user_read", "user_details_read", "product_read", "product_details_read"})
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}