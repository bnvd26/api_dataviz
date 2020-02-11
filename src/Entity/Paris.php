<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParisRepository")
 */
class Paris
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $borough;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countHotel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="json")
     */
    private $polygon = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure", mappedBy="place")
     */
    private $infrastructures;

    public function __construct()
    {
        $this->infrastructures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getBorough(): ?string
    {
        return $this->borough;
    }

    public function setBorough(?string $borough): self
    {
        $this->borough = $borough;

        return $this;
    }

    public function getCountHotel(): ?string
    {
        return $this->countHotel;
    }

    public function setCountHotel(?string $countHotel): self
    {
        $this->countHotel = $countHotel;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Infrastructure[]
     */
    public function getInfrastructures(): Collection
    {
        return $this->infrastructures;
    }

    public function addInfrastructure(Infrastructure $infrastructure): self
    {
        if (!$this->infrastructures->contains($infrastructure)) {
            $this->infrastructures[] = $infrastructure;
            $infrastructure->setPlace($this);
        }

        return $this;
    }

    public function removeInfrastructure(Infrastructure $infrastructure): self
    {
        if ($this->infrastructures->contains($infrastructure)) {
            $this->infrastructures->removeElement($infrastructure);
            // set the owning side to null (unless already changed)
            if ($infrastructure->getPlace() === $this) {
                $infrastructure->setPlace(null);
            }
        }

        return $this;
    }

    public function getPolygon(): array
    {
        $polygon = $this->polygon;

        return $polygon;
    }

    public function setPolygon(array $polygon): self
    {
        $this->polygon = $polygon;

        return $this;
    }

}
