<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Vich\Uploadable]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $eventName = null;

    #[ORM\Column (nullable: false)]
    private ?\DateTime $eventDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $eventDescription;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $eventImageName = null;

    #[Vich\UploadableField(mapping: 'events', fileNameProperty: 'eventImageName')]
    private ?File $eventImageFile = null;

    #[ORM\Column]
    private ?float $coordinateLat = null;

    #[ORM\Column]
    private ?float $coordinateLng = null;

    #[ORM\Column(length: 255)]
    private ?string $eventSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $eventUpdatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: true)] //Modif pour test
    private ?TypeEvent $typeEvent = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'eventsParticipation')]
    private Collection $participants;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $infoLocation;

    #[ORM\ManyToOne(inversedBy: 'eventCreator')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $creator = null;

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

    public function getEventImageFile(): ?File
    {
        return $this->eventImageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $eventImageFile
     */
    public function setEventImageFile(?File $eventImageFile = null): void
    {
        $this->eventImageFile = $eventImageFile;

        if (null !== $eventImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->eventUpdatedAt= new \DateTimeImmutable();
        }
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

    public function getTypeEvent(): ?TypeEvent
    {
        return $this->typeEvent;
    }

    public function setTypeEvent(?TypeEvent $typeEvent): static
    {
        $this->typeEvent = $typeEvent;

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

    public function getInfoLocation(): ?string
    {
        return $this->infoLocation;
    }

    public function setInfoLocation(string $infoLocation): static
    {
        $this->infoLocation = $infoLocation;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;
        return $this;
    }
    
}