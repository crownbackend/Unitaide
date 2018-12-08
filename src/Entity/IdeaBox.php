<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IdeaBoxRepository")
 */
class IdeaBox
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $idea;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdea(): ?string
    {
        return $this->idea;
    }

    public function setIdea(string $idea): self
    {
        $this->idea = $idea;

        return $this;
    }
}
