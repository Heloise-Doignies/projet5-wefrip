<?php

namespace App\Entity;

use Serializable;
use App\Repository\AvatarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AvatarRepository::class)]
#[Vich\Uploadable]
class Avatar implements Serializable
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'avatars', fileNameProperty: 'imageName')]
    #[Assert\Image(minWidth: 300, maxWidth: 600, minHeight: 300, maxHeight: 600, minWidthMessage: 'La largeur de l\'image doit être comprise entre 300 et 600 pixels', maxWidthMessage: 'La largeur de l\'image doit être comprise entre 300 et 600 pixels', minHeightMessage: 'La hauteur de l\'image doit être comprise entre 300 et 600 pixels', maxHeightMessage: 'La hauteur de l\'image doit être comprise entre 300 et 600 pixels')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'avatar', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    private ?string $isCustomAvatar = null;

    // ====================================================== //
    // =================== MAGIC FUNCTION =================== //
    // ====================================================== //
    public function __toString(): string
    {
        return (!is_null($this->imageName)) ? $this->imageName : '';
    }

    // ====================================================== //
    // ====================== INTERFACE ===================== //
    // ====================================================== //

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->imageName,

        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,

        ) = unserialize($serialized);
    }

    // ====================================================== //
    // =================== GETTERS/SETTERS ================== //
    // ====================================================== //
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of isCustomAvatar
     */ 
    public function getIsCustomAvatar()
    {
        return  (!is_null($this->imageName)) ? $this->imageName : "false";
    }

    /**
     * Set the value of isCustomAvatar
     *
     * @return  self
     */ 
    public function setIsCustomAvatar($isCustomAvatar)
    {
        $this->isCustomAvatar = $isCustomAvatar;

        return $this;
    }
}
