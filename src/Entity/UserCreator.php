<?php

namespace App\Entity;

use App\Repository\UserCreatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCreatorRepository::class)]
class UserCreator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $creatorUpdatedAt = null;

    #[ORM\OneToOne(mappedBy: 'userCreator', cascade: ['persist', 'remove'])]
    private ?User $userId = null;

    #[ORM\OneToMany(mappedBy: 'userCreator', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'userCreator', targetEntity: InfoLocation::class)]
    private Collection $infoLocations;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $userData = [];

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->infoLocations = new ArrayCollection();
    }

    //Pour utiliser le UserCreator comme string
    public function __toString(): string
    {
        $pseudo = $this->userData['pseudo'] ?? '';
        $firstname = $this->userData['firstname'] ?? '';
        $lastname = $this->userData['lastname'] ?? '';
    
        return $pseudo . ' ' .  $firstname . ' ' . $lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatorUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->creatorUpdatedAt;
    }

    public function setCreatorUpdatedAt(?\DateTimeImmutable $creatorUpdatedAt): static
    {
        $this->creatorUpdatedAt = $creatorUpdatedAt;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        // unset the owning side of the relation if necessary
        if ($userId === null && $this->userId !== null) {
            $this->userId->setUserCreator(null);
        }

        // set the owning side of the relation if necessary
        if ($userId !== null && $userId->getUserCreator() !== $this) {
            $userId->setUserCreator($this);
        }

        $this->userId = $userId;

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
            $event->setUserCreator($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUserCreator() === $this) {
                $event->setUserCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InfoLocation>
     */
    public function getInfoLocations(): Collection
    {
        return $this->infoLocations;
    }

    public function addInfoLocation(InfoLocation $infoLocation): static
    {
        if (!$this->infoLocations->contains($infoLocation)) {
            $this->infoLocations->add($infoLocation);
            $infoLocation->setUserCreator($this);
        }

        return $this;
    }

    public function removeInfoLocation(InfoLocation $infoLocation): static
    {
        if ($this->infoLocations->removeElement($infoLocation)) {
            // set the owning side to null (unless already changed)
            if ($infoLocation->getUserCreator() === $this) {
                $infoLocation->setUserCreator(null);
            }
        }

        return $this;
    }

    public function getUserData(): array
    {
        return $this->userData;
    }

    public function setUserData(?array $userData): static
    {
        $this->userData = $userData;

        return $this;
    }
}
