<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubwayLineRepository")
 */
class SubwayLine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lineLogo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Paris", inversedBy="subwayLines")
     */
    private $boroughs;

    public function __construct()
    {
        $this->boroughs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLineLogo(): ?string
    {
        return $this->lineLogo;
    }

    public function setLineLogo(string $lineLogo): self
    {
        $this->lineLogo = $lineLogo;

        return $this;
    }

    /**
     * @return Collection|Paris[]
     */
    public function getBoroughs(): Collection
    {
        return $this->boroughs;
    }

    public function addBorough(Paris $borough): self
    {
        if (!$this->boroughs->contains($borough)) {
            $this->boroughs[] = $borough;
        }

        return $this;
    }

    public function removeBorough(Paris $borough): self
    {
        if ($this->boroughs->contains($borough)) {
            $this->boroughs->removeElement($borough);
        }

        return $this;
    }
}
