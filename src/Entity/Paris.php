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
    private $prefix;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $averageHotelPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $AverageRestaurantPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $costPerDay;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subwayStationsNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infrastructure", mappedBy="place")
     */
    private $infrastructures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SubwayLine", mappedBy="boroughs")
     */
    private $subwayLines;

    public function __construct()
    {
        $this->infrastructures = new ArrayCollection();
        $this->subwayLines = new ArrayCollection();
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

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getAverageHotelPrice(): ?int
    {
        return $this->averageHotelPrice;
    }

    public function setAverageHotelPrice(?int $averageHotelPrice): self
    {
        $this->averageHotelPrice = $averageHotelPrice;
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
    }

    public function getAverageRestaurantPrice(): ?int
    {
        return $this->AverageRestaurantPrice;
    }

    public function setAverageRestaurantPrice(?int $AverageRestaurantPrice): self
    {
        $this->AverageRestaurantPrice = $AverageRestaurantPrice;

        return $this;
    }

    public function getSubwayStationsNumber(): ?int
    {
        return $this->subwayStationsNumber;
    }

    public function setSubwayStationsNumber(?int $subwayStationsNumber): self
    {
        $this->subwayStationsNumber = $subwayStationsNumber;
        return $this;
    }

    public function getCostPerDay(): ?int
    {
        return $this->costPerDay;
    }

    public function setCostPerDay(?int $costPerDay): void
    {
        $this->costPerDay = $costPerDay;
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
    }

    /**
     * @return Collection|SubwayLine[]
     */
    public function getSubwayLines(): Collection
    {
        return $this->subwayLines;
    }

    public function addSubwayLine(SubwayLine $subwayLine): self
    {
        if (!$this->subwayLines->contains($subwayLine)) {
            $this->subwayLines[] = $subwayLine;
            $subwayLine->addBorough($this);
        }

        return $this;
    }

    public function removeSubwayLine(SubwayLine $subwayLine): self
    {
        if ($this->subwayLines->contains($subwayLine)) {
            $this->subwayLines->removeElement($subwayLine);
            $subwayLine->removeBorough($this);
        }

        return $this;
    }
}
