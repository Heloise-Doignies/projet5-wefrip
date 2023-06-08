<?php

namespace App\Entity;

use App\Repository\TypeVideDressingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeVideDressingRepository::class)]
class TypeVideDressing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $clothesGender = null;

    #[ORM\Column(length: 255)]
    private ?string $clothesSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $videDressingUpdatedAt = null;

    #[ORM\OneToOne(mappedBy: 'typeVideDressing', cascade: ['persist', 'remove'])]
    private ?TypeEvent $typeEvent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClothesGender(): ?string
    {
        return $this->clothesGender;
    }

    public function setClothesGender(string $clothesGender): static
    {
        $this->clothesGender = $clothesGender;

        return $this;
    }

    public function getClothesSize(): ?string
    {
        return $this->clothesSize;
    }

    public function setClothesSize(string $clothesSize): static
    {
        $this->clothesSize = $clothesSize;

        return $this;
    }

    public function getVideDressingUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->videDressingUpdatedAt;
    }

    public function setVideDressingUpdatedAt(?\DateTimeImmutable $videDressingUpdatedAt): static
    {
        $this->videDressingUpdatedAt = $videDressingUpdatedAt;

        return $this;
    }

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(?TypeEvent $typeEvent): static
    {
        // unset the owning side of the relation if necessary
        if ($typeEvent === null && $this->typeEvent !== null) {
            $this->typeEvent->setTypeVideDressing(null);
        }

        // set the owning side of the relation if necessary
        if ($typeEvent !== null && $typeEvent->getTypeVideDressing() !== $this) {
            $typeEvent->setTypeVideDressing($this);
        }

        $this->typeEvent = $typeEvent;

        return $this;
    }
}
