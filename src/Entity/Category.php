<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Vich\Uploadable]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $categoryName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categorySlug = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $categoryUpdatedAt = null;

    #[ORM\ManyToMany(targetEntity: Tutorial::class, mappedBy: 'categories')]
    private Collection $tutorials;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categoryImageName = null;

    #[Vich\UploadableField(mapping: 'categories', fileNameProperty: 'categoryImageName')]
    private ?File $categoryImageFile = null;

    public function __construct()
    {
        $this->tutorials = new ArrayCollection();
        $this->setCategoryUpdatedAt(new DateTimeImmutable('now'));
    }

    //Fonction pour dire que si cette propriété est utilisée, elle est une chaine de caractères
    public function __toString(): string
    {
        return $this->categoryName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): static
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getCategorySlug(): ?string
    {
        return $this->categorySlug;
    }

    public function setCategorySlug(?string $categorySlug): static
    {
        $this->categorySlug = $categorySlug;

        return $this;
    }


    public function getCategoryUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->categoryUpdatedAt;
    }

    public function setCategoryUpdatedAt(?\DateTimeImmutable $categoryUpdatedAt): static
    {
        $this->categoryUpdatedAt = $categoryUpdatedAt;

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
            $tutorial->addCategory($this);
        }

        return $this;
    }

    public function removeTutorial(Tutorial $tutorial): static
    {
        if ($this->tutorials->removeElement($tutorial)) {
            $tutorial->removeCategory($this);
        }

        return $this;
    }

    public function getCategoryImageName(): ?string
    {
        return $this->categoryImageName;
    }

    public function setCategoryImageName(?string $categoryImageName): static
    {
        $this->categoryImageName = $categoryImageName;

        return $this;
    }

    public function getCategoryImageFile(): ?File
    {
        return $this->categoryImageFile;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $categoryImageFile
     */
    public function setCategoryImageFile(?File $categoryImageFile = null): void
    {
        $this->categoryImageFile = $categoryImageFile;

        if (null !== $categoryImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->categoryUpdatedAt= new \DateTimeImmutable();
        }
    }
    
}
