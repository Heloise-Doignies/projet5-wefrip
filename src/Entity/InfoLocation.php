<?php

namespace App\Entity;

use App\Repository\InfoLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoLocationRepository::class)]
class InfoLocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $infoLocDescription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $infoLocUpdatedAt = null;

    #[ORM\OneToOne(mappedBy: 'infosLocation', cascade: ['persist', 'remove'])]
    private ?Event $event = null;

    #[ORM\ManyToOne(inversedBy: 'infoLocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserCreator $userCreator = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getInfoLocDescription(): ?string
    {
        return $this->infoLocDescription;
    }

    public function setInfoLocDescription(?string $infoLocDescription): static
    {
        $this->infoLocDescription = $infoLocDescription;

        return $this;
    }

    public function getInfoLocUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->infoLocUpdatedAt;
    }

    public function setInfoLocUpdatedAt(?\DateTimeImmutable $infoLocUpdatedAt): static
    {
        $this->infoLocUpdatedAt = $infoLocUpdatedAt;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): static
    {
        // set the owning side of the relation if necessary
        if ($event->getInfosLocation() !== $this) {
            $event->setInfosLocation($this);
        }

        $this->event = $event;

        return $this;
    }

    public function getUserCreator(): ?UserCreator
    {
        return $this->userCreator;
    }

    public function setUserCreator(?UserCreator $userCreator): static
    {
        $this->userCreator = $userCreator;

        return $this;
    }

}
