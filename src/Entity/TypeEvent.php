<?php

namespace App\Entity;

use App\Repository\TypeEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEventRepository::class)]
class TypeEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $typeDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $typeSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $typeUpdatedAt = null;

    #[ORM\OneToMany(mappedBy: 'typeEvent', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToOne(inversedBy: 'typeEvent', cascade: ['persist', 'remove'])]
    private ?TypeVideDressing $typeVideDressing = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->typeName;
    }

    public function setTypeName(string $typeName): static
    {
        $this->typeName = $typeName;

        return $this;
    }

    public function getTypeDescription(): ?string
    {
        return $this->typeDescription;
    }

    public function setTypeDescription(?string $typeDescription): static
    {
        $this->typeDescription = $typeDescription;

        return $this;
    }

    public function getTypeSlug(): ?string
    {
        return $this->typeSlug;
    }

    public function setTypeSlug(string $typeSlug): static
    {
        $this->typeSlug = $typeSlug;

        return $this;
    }

    public function getTypeUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->typeUpdatedAt;
    }

    public function setTypeUpdatedAt(?\DateTimeImmutable $typeUpdatedAt): static
    {
        $this->typeUpdatedAt = $typeUpdatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setTypeEvent($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getTypeEvent() === $this) {
                $event->setTypeEvent(null);
            }
        }

        return $this;
    }

    public function getTypeVideDressing(): ?TypeVideDressing
    {
        return $this->typeVideDressing;
    }

    public function setTypeVideDressing(?TypeVideDressing $typeVideDressing): static
    {
        $this->typeVideDressing = $typeVideDressing;

        return $this;
    }
}
