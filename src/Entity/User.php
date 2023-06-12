<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatarName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $userSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $userUpdatedAt = null;

    #[ORM\ManyToMany(targetEntity: Favori::class, inversedBy: 'users')]
    private Collection $favoris;

    #[ORM\OneToOne(inversedBy: 'userId', cascade: ['persist', 'remove'])]
    private ?UserCreator $userCreator = null;

    #[ORM\ManyToMany(targetEntity: UserParticipant::class, inversedBy: 'usersId')]
    private Collection $participantEvent;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->participantEvent = new ArrayCollection();
    }

    //Fonction pour dire que si cette propriété est utilisée, elle est une chaine de caractères
    public function __toString(): string
    {
        return $this->email;
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

    /**
     * @return Collection<int, Favori>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favori $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): static
    {
        $this->favoris->removeElement($favori);

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

    /**
     * @return Collection<int, UserParticipant>
     */
    public function getParticipantEvent(): Collection
    {
        return $this->participantEvent;
    }

    public function addParticipantEvent(UserParticipant $participantEvent): static
    {
        if (!$this->participantEvent->contains($participantEvent)) {
            $this->participantEvent->add($participantEvent);
        }

        return $this;
    }

    public function removeParticipantEvent(UserParticipant $participantEvent): static
    {
        $this->participantEvent->removeElement($participantEvent);

        return $this;
    }
}
