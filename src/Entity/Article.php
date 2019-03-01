<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable()
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 255,
     *      minMessage = "Votre titre doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Votre titre doit contenir au maximum {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="20",
     *     minMessage="Votre description doit contenir au minimum {{ limit }} caractères"
     * )
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
     * @ORM\Column(type="text")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="article", orphanRemoval=true, cascade={"persist", "remove"})
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="imageNameMiniature")
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=154)
     */
    private $seoDescription;

    /**
     * Article constructor.
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

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
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
            $image->setArticle($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getArticle() === $this) {
                $image->setArticle(null);
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

    public function getSlug()
    {
        return $this->slug;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

}
