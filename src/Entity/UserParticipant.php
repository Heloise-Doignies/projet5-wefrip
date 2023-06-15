<?php

namespace App\Entity;

use App\Repository\UserParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserParticipantRepository::class)]
class UserParticipant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $participantUpdatedAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'participantEvent')]
    private Collection $usersId;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'userParticipant')]
    private Collection $events;

    #[ORM\ManyToMany(targetEntity: InfoLocation::class, mappedBy: 'userParticipant')]
    private Collection $infoLocations;

    public function __construct()
    {
        $this->usersId = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->infoLocations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId(); // ou toute autre représentation en chaîne de caractères de l'objet
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticipantUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->participantUpdatedAt;
    }

    public function setParticipantUpdatedAt(?\DateTimeImmutable $participantUpdatedAt): static
    {
        $this->participantUpdatedAt = $participantUpdatedAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersId(): Collection
    {
        return $this->usersId;
    }

    public function addUsersId(User $usersId): static
    {
        if (!$this->usersId->contains($usersId)) {
            $this->usersId->add($usersId);
            $usersId->addParticipantEvent($this);
        }

        return $this;
    }

    public function removeUsersId(User $usersId): static
    {
        if ($this->usersId->removeElement($usersId)) {
            $usersId->removeParticipantEvent($this);
        }

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
            $event->addUserParticipant($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            $event->removeUserParticipant($this);
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
            $infoLocation->addUserParticipant($this);
        }

        return $this;
    }

    public function removeInfoLocation(InfoLocation $infoLocation): static
    {
        if ($this->infoLocations->removeElement($infoLocation)) {
            $infoLocation->removeUserParticipant($this);
        }

        return $this;
    }
}
