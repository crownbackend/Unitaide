<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endEvent;

    /**
     * @ORM\Column(type="string", length=154)
     */
    private $seoDescription;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="event_image_miniature", fileNameProperty="imageNameMiniature")
     *
     * @var File
     */
    private $imageFileMiniature;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageNameMiniature;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="event", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @Assert\All({
     *   @Assert\Image(
     *     mimeTypes={"image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Please upload a valid Image",
     *     maxSize="8024k"
     * )
     * })
     */
    private $imageFiles;

    /**
     * Event constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEndEvent(): ?\DateTimeInterface
    {
        return $this->endEvent;
    }

    public function setEndEvent(\DateTimeInterface $endEvent): self
    {
        $this->endEvent = $endEvent;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(string $seoDescription): self
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param File|null $imageFileMiniature
     * @throws \Exception
     */
    public function setImageFileMiniature(?File $imageFileMiniature = null): void
    {
        $this->imageFileMiniature = $imageFileMiniature;

        if (null !== $imageFileMiniature) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFileMiniature(): ?File
    {
        return $this->imageFileMiniature;
    }

    public function setImageNameMiniature(?string $imageNameMiniature): void
    {
        $this->imageNameMiniature = $imageNameMiniature;
    }

    public function getImageNameMiniature(): ?string
    {
        return $this->imageNameMiniature;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setEvent($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getEvent() === $this) {
                $image->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFiles()
    {
        return $this->imageFiles;
    }

    public function setImageFiles($imageFiles): self
    {
        foreach($imageFiles as $imageFile) {
            $image = new Image();
            $image->setImageFile($imageFile);
            $this->addImage($image);
        }
        $this->imageFiles = $imageFiles;
        return $this;
    }
}
