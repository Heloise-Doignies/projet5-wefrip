<?php

namespace App\Entity;

use App\Repository\FavoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriRepository::class)]
class Favori
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFav = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $favUpdatedAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favoris')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Tutorial::class, mappedBy: 'tutoFavoris')]
    private Collection $tutorials;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->tutorials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsFav(): ?bool
    {
        return $this->isFav;
    }

    public function setIsFav(?bool $isFav): static
    {
        $this->isFav = $isFav;

        return $this;
    }

    public function getFavUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->favUpdatedAt;
    }

    public function setFavUpdatedAt(?\DateTimeImmutable $favUpdatedAt): static
    {
        $this->favUpdatedAt = $favUpdatedAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addFavori($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavori($this);
        }

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
            $tutorial->addTutoFavori($this);
        }

        return $this;
    }

    public function removeTutorial(Tutorial $tutorial): static
    {
        if ($this->tutorials->removeElement($tutorial)) {
            $tutorial->removeTutoFavori($this);
        }

        return $this;
    }
}
