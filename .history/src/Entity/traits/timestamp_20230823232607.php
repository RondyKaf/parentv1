<?php

namespace App\Entity\Traits;


/**
 * 
 */
trait Timestampable
{
    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $createdAt = null;


    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeImmutable $updatedAt = null;
}