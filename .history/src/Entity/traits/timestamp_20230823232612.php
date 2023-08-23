<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;


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