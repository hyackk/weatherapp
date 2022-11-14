<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $city = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $longitude = null;
	
	#[ORM\Column(length: 2)]
    private ?string $country = null;

    #[ORM\OneToMany(mappedBy: 'location_id', targetEntity: Weather::class)]
    private Collection $weather;

    public function __construct()
    {
        $this->weather = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

	public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Transform to string
     */
    public function __toString()
    {
        return (string) $this->getCity();
    }


    /**
     * @return Collection<int, Weather>
     */
    public function getWeather(): Collection
    {
        return $this->weather;
    }

    public function addWeather(Weather $weather): self
    {
        if (!$this->weather->contains($weather)) {
            $this->weather->add($weather);
            $weather->setLocation($this);
        }

        return $this;
    }

    public function removeWeather(Weather $weather): self
    {
        if ($this->weather->removeElement($weather)) {
            // set the owning side to null (unless already changed)
            if ($weather->getLocation() === $this) {
                $weather->setLocation(null);
            }
        }

        return $this;
    }
}
