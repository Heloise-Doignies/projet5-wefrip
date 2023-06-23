<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[Vich\Uploadable]
#[UniqueEntity(fields: ['email'], message: "L'adresse e-mail existe déjà, veuillez en choisir un autre.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(
        message: "L'email {{ value }} n'est pas un email valide"
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;
    /*pour pouvoir confirmer le mdp a mettre en private apres test*/
    public $confirm_password;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatarName = null;

    #[Vich\UploadableField(mapping: 'users', fileNameProperty: 'avatarName')]
    private ?File $avatarFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $userUpdatedAt = null;

    /*     #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $registeredAt = null; */

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToMany(targetEntity: Tutorial::class, inversedBy: 'users')]
    private Collection $tutorials;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'participants')]
    private Collection $eventsParticipation;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Event::class)]
    private Collection $eventCreator;

    public function __construct()
    {
        $this->tutorials = new ArrayCollection();
        $this->eventsParticipation = new ArrayCollection();
        $this->eventCreator = new ArrayCollection();
    }

    //Fonction pour dire que si cette propriété est utilisée, elle est une chaine de caractères
    public function __toString(): string
    {
        return (!is_null($this->pseudo)) ? $this->pseudo : $this->firstname . " " . $this->lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatarName(): ?string
    {
        return $this->avatarName;
    }

    public function setAvatarName(?string $avatarName): static
    {
        $this->avatarName = $avatarName;

        return $this;
    }
    public function getAvatarFile(): ?File
    {
        return $this->avatarFile;
    }
    public function setAvatarFile(?File $AvatarFile = null): void
    {
        $this->avatarFile = $AvatarFile;

        if (null !== $AvatarFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->userUpdatedAt = new \DateTimeImmutable();
        }
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getUserSlug(): ?string
    {
        return $this->userSlug;
    }

    public function setUserSlug(string $userSlug): static
    {
        $this->userSlug = $userSlug;

        return $this;
    }

    public function getUserUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->userUpdatedAt;
    }

    public function setUserUpdatedAt(?\DateTimeImmutable $userUpdatedAt): static
    {
        $this->userUpdatedAt = $userUpdatedAt;

        return $this;
    }

    /*     public function $registeredAt(): ?\DateTimeImmutable
    {
        return $this->registeredAt;
    }

    public function setUserUpdatedAt(?\DateTimeImmutable $registeredAt): static
    {
        $this->registeredAt = $registeredAt;

        return $this;
    } */

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Tutorial>
     */
    public function getTutorials(): Collection
    {
        return $this->tutorials;
    }

    public function addTutorial(Tutorial $tutorial): static
    {
        if (!$this->tutorials->contains($tutorial)) {
            $this->tutorials->add($tutorial);
        }

        return $this;
    }

    public function removeTutorial(Tutorial $tutorial): static
    {
        $this->tutorials->removeElement($tutorial);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventsParticipation(): Collection
    {
        return $this->eventsParticipation;
    }

    public function addEventsParticipation(Event $eventsParticipation): static
    {
        if (!$this->eventsParticipation->contains($eventsParticipation)) {
            $this->eventsParticipation->add($eventsParticipation);
            $eventsParticipation->addParticipant($this);
        }

        return $this;
    }

    public function removeEventsParticipation(Event $eventsParticipation): static
    {
        if ($this->eventsParticipation->removeElement($eventsParticipation)) {
            $eventsParticipation->removeParticipant($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventCreator(): Collection
    {
        return $this->eventCreator;
    }

    public function addEventCreator(Event $eventCreator): static
    {
        if (!$this->eventCreator->contains($eventCreator)) {
            $this->eventCreator->add($eventCreator);
            $eventCreator->setCreator($this);
        }

        return $this;
    }

    public function removeEventCreator(Event $eventCreator): static
    {
        if ($this->eventCreator->removeElement($eventCreator)) {
            // set the owning side to null (unless already changed)
            if ($eventCreator->getCreator() === $this) {
                $eventCreator->setCreator(null);
            }
        }

        return $this;
    }
}
