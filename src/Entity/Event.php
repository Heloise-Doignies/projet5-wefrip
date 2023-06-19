<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $eventName = null;

    #[ORM\Column (nullable: true)] //Modif pour test : en nullable true
    private ?\DateTime $eventDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $eventDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eventImageName = null;

    #[ORM\Column]
    private ?float $coordinateLat = null;

    #[ORM\Column]
    private ?float $coordinateLng = null;

    #[ORM\Column(length: 255)]
    private ?string $eventSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $eventUpdatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'events', cascade:['persist'])]
    #[ORM\JoinColumn(nullable: true)] //Modif pour test
    private ?UserCreator $userCreator = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: true)] //Modif pour test
    private ?TypeEvent $typeEvent = null;

    #[ORM\OneToOne(inversedBy: 'event', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)] //Modif pour test
    private ?InfoLocation $infosLocation = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'eventsParticipation')]
    private Collection $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

        //Fonction pour dire que si cette propriété est utilisée, elle est une chaine de caractères
    public function __toString(): string
    {
        return $this->eventName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): static
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getEventDate(): ?\DateTime
    {
        return $this->eventDate;
    }

    public function setEventDate(\DateTime $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getEventDescription(): ?string
    {
        return $this->eventDescription;
    }

    public function setEventDescription(string $eventDescription): static
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    public function getEventImageName(): ?string
    {
        return $this->eventImageName;
    }

    public function setEventImageName(?string $eventImageName): static
    {
        $this->eventImageName = $eventImageName;

        return $this;
    }

    public function getCoordinateLat(): ?float
    {
        return $this->coordinateLat;
    }

    public function setCoordinateLat(float $coordinateLat): static
    {
        $this->coordinateLat = $coordinateLat;

        return $this;
    }

    public function getCoordinateLng(): ?float
    {
        return $this->coordinateLng;
    }

    public function setCoordinateLng(float $coordinateLng): static
    {
        $this->coordinateLng = $coordinateLng;

        return $this;
    }

    public function getEventSlug(): ?string
    {
        return $this->eventSlug;
    }

    public function setEventSlug(string $eventSlug): static
    {
        $this->eventSlug = $eventSlug;

        return $this;
    }

    public function getEventUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->eventUpdatedAt;
    }

    public function setEventUpdatedAt(?\DateTimeImmutable $eventUpdatedAt): static
    {
        $this->eventUpdatedAt = $eventUpdatedAt;

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

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(?TypeEvent $typeEvent): static
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    public function getInfosLocation(): ?InfoLocation
    {
        return $this->infosLocation;
    }

    public function setInfosLocation(InfoLocation $infosLocation): static
    {
        $this->infosLocation = $infosLocation;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
        }

        return $this;
    }

    public function removeParticipant(User $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }
}
