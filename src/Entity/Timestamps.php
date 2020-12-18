<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Timestamps{

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user_read", "user_details_read","product_read", "product_details_read"})
     */
    private $createdAt;

     /**
     * @ORM\Column(type="datetime",nullable=true)
     * @Groups({"user_read", "user_details_read","product_read", "product_details_read"})
     */
    private $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function createdAt(){
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function updatedAt(){
        $this->updatedAt = new \DateTime();
    }
}