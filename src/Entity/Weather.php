<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(nullable: true)]
    private ?int $pressure = null;

    #[ORM\Column(nullable: true)]
    private ?int $visibility = null;

    #[ORM\Column(nullable: true)]
    private ?float $wind_speed = null;

    #[ORM\Column(nullable: true)]
    private ?int $wind_deg = null;

    #[ORM\Column(nullable: true)]
    private ?float $clouds = null;

    #[ORM\Column(nullable: true)]
    private ?float $humidity = null;

    #[ORM\Column(nullable: true)]
    private ?float $temp_max = null;

    #[ORM\Column(nullable: true)]
    private ?float $temp_min = null;

    #[ORM\Column(nullable: true)]
    private ?float $temp_avg = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weather_description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weather_name = null;

    #[ORM\Column(nullable: true)]
    private ?int $timezone = null;

    #[ORM\ManyToOne(inversedBy: 'weather')]
    ##[ORM\ManyToOne(targetEntity: Location::class)]
    #[ORM\JoinColumn(name: 'location_id', referencedColumnName: 'id')]
    //#[ORM\JoinColumn(nullable: false)]
    private ?Location $location_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function setPressure(?int $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getVisibility(): ?int
    {
        return $this->visibility;
    }

    public function setVisibility(?int $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->wind_speed;
    }

    public function setWindSpeed(?float $wind_speed): self
    {
        $this->wind_speed = $wind_speed;

        return $this;
    }

    public function getWindDeg(): ?int
    {
        return $this->wind_deg;
    }

    public function setWindDeg(?int $wind_deg): self
    {
        $this->wind_deg = $wind_deg;

        return $this;
    }

    public function getClouds(): ?float
    {
        return $this->clouds;
    }

    public function setClouds(?float $clouds): self
    {
        $this->clouds = $clouds;

        return $this;
    }

    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    public function setHumidity(?float $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getTempMax(): ?float
    {
        return $this->temp_max;
    }

    public function setTempMax(?float $temp_max): self
    {
        $this->temp_max = $temp_max;

        return $this;
    }

    public function getTempMin(): ?float
    {
        return $this->temp_min;
    }

    public function setTempMin(?float $temp_min): self
    {
        $this->temp_min = $temp_min;

        return $this;
    }

    public function getTempAvg(): ?float
    {
        return $this->temp_avg;
    }

    public function setTempAvg(?float $temp_avg): self
    {
        $this->temp_avg = $temp_avg;

        return $this;
    }

    public function getWeatherDescription(): ?string
    {
        return $this->weather_description;
    }

    public function setWeatherDescription(?string $weather_description): self
    {
        $this->weather_description = $weather_description;

        return $this;
    }

    public function getWeatherName(): ?string
    {
        return $this->weather_name;
    }

    public function setWeatherName(?string $weather_name): self
    {
        $this->weather_name = $weather_name;

        return $this;
    }

    public function getTimezone(): ?int
    {
        return $this->timezone;
    }

    public function setTimezone(?int $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getLocation(): ?location
    {
        return $this->location_id;
    }

    public function setLocation(?location $location): self
    {
        $this->location_id = $location;

        return $this;
    }

    
}
