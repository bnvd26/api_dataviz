<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InfrastructureRepository")
 */
class Infrastructure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="json")
     */
    private $sports = [];


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Paris", inversedBy="infrastructures")
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site;


    public function getSports(): array
    {
        $sports = $this->sports;

        return array_unique($sports);
    }

    public function setSports(array $sports): self
    {
        $this->sports = $sports;

        return $this;
    }

    public function getPlace(): ?Paris
    {
        return $this->place;
    }

    public function setPlace(?Paris $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }
}
