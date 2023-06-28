<?php

namespace App\Entity;

use App\Repository\TutorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: TutorialRepository::class)]
#[Vich\Uploadable]
class Tutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tutoName = null;
    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tutoShortDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tutoDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tutoFileName = null;

    #[Vich\UploadableField(mapping: 'tutorials', fileNameProperty: 'tutoFileName')]
    private ?File $tutoFile = null;
    
    #[Vich\UploadableField(mapping: 'tutorials', fileNameProperty: 'tutoVideoName')]
    private ?File $tutoVideoFile = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tutoVideoName = null;

    #[Vich\UploadableField(mapping: 'tutorials', fileNameProperty: 'tutoImageName')]
    private ?File $tutoImageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tutoImageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tutoSupportType = null;

    #[ORM\Column(length: 255)]
    private ?string $tutoSlug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $tutoUpdatedAt = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'tutorials')]
    private Collection $categories;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'tutorials')]
    private Collection $users;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    //Fonction pour dire que si cette propriété est utilisée, elle est une chaine de caractères
    public function __toString(): string
    {
        return $this->tutoName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTutoName(): ?string
    {
        return $this->tutoName;
    }

    public function setTutoName(?string $tutoName): static
    {
        $this->tutoName = $tutoName;

        return $this;
    }

    public function getTutoShortDescription(): ?string
    {
        return $this->tutoShortDescription;
    }

    public function setTutoShortDescription(?string $tutoShortDescription): static
    {
        $this->tutoShortDescription = $tutoShortDescription;

        return $this;
    }

    public function getTutoDescription(): ?string
    {
        return $this->tutoDescription;
    }

    public function setTutoDescription(?string $tutoDescription): static
    {
        $this->tutoDescription = $tutoDescription;

        return $this;
    }

    // Pour le vich : on met en place les fonctions getTutoFile et setTutoFile (pour FileName)
    public function getTutoFile(): ?File
    {
        return $this->tutoFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $tutoFile
     */
    public function setTutoFile(?File $tutoFile = null): void
    {
        $this->tutoFile = $tutoFile;

        if (null !== $tutoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->tutoUpdatedAt = new \DateTimeImmutable();
        }
    }

    public function getTutoFileName(): ?string
    {
        return $this->tutoFileName;
    }

    public function setTutoFileName(?string $tutoFileName): static
    {
        $this->tutoFileName = $tutoFileName;

        return $this;
    }

    public function getTutoVideoName(): ?string
    {
        return $this->tutoVideoName;
    }

    public function setTutoVideoName(?string $tutoVideoName): static
    {
        $this->tutoVideoName = $tutoVideoName;

        return $this;
    }
    public function getTutoVideoFile(): ?File
    {
        return $this->tutoVideoFile;
    }
    public function setTutoVideoFile(?File $tutoVideoFile = null): void
    {
        $this->tutoVideoFile = $tutoVideoFile;

        if (null !== $tutoVideoFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->tutoUpdatedAt = new \DateTimeImmutable();
        }
    }

    public function getTutoImageName(): ?string
    {
        return $this->tutoImageName;
    }

    public function setTutoImageName(?string $tutoImageName): static
    {
        $this->tutoImageName = $tutoImageName;

        return $this;
    }

    //Pour le vich : on met en place les fonctions getTutoImageFile et setTutoImageFile (pour ImageName)
    public function getTutoImageFile(): ?File
    {
        return $this->tutoImageFile;
    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $tutoImageFile
     */
    public function setTutoImageFile(?File $tutoImageFile = null): void
    {
        $this->tutoImageFile = $tutoImageFile;

        if (null !== $tutoImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->tutoUpdatedAt = new \DateTimeImmutable();
        }
    }

    public function getTutoSupportType(): ?string
    {
        return $this->tutoSupportType;
    }

    public function setTutoSupportType(?string $tutoSupportType): static
    {
        $this->tutoSupportType = $tutoSupportType;

        return $this;
    }

    public function getTutoSlug(): ?string
    {
        return $this->tutoSlug;
    }

    public function setTutoSlug(string $tutoSlug): static
    {
        $this->tutoSlug = $tutoSlug;

        return $this;
    }

    public function getTutoUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->tutoUpdatedAt;
    }

    public function setTutoUpdatedAt(?\DateTimeImmutable $tutoUpdatedAt): static
    {
        $this->tutoUpdatedAt = $tutoUpdatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
          /*   $category->addCategory($this); */
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

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
            $user->addTutorial($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeTutorial($this);
        }

        return $this;
    }
}
