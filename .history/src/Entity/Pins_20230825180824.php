<?php

namespace App\Entity;

use App\Entity\Traits\Timestampables;
use App\Repository\PinsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PinsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Pins
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 3, minMessage: "doit contenir au moins 3 caractères")]

    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 10, minMessage: "doit contenir au moins 10 caractères")]

    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Vich\UploadableField(mapping: 'pin_image', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?string $imageName = null;
    use Timestampables;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }


}