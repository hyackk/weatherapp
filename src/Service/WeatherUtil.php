<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\WeatherRepository;
use App\Repository\LocationRepository;

class WeatherUtil
{
    /**
     * @var WeatherRepository
     */
    private $weatherRepository;
    /**
     * @var LocationRepository
     */
    private $locationRepository;

    public function __construct(WeatherRepository $weatherRepository, LocationRepository $locationRepository)
    {

        $this->weatherRepository = $weatherRepository;
        $this->locationRepository = $locationRepository;
    }

    public function getWeatherForCountryAndCity( $country, $cityName): array
    {
        $location=$this->locationRepository->findOneBy([
            "country" => $country,
            "city" => $cityName
        ]);

        $weathers=$this->getWeatherForLocation($location);
        return $weathers;
    }

    public function getWeatherForLocation($location):array
    {
        $weathers= $this->weatherRepository->findByLocation($location);
		return $weathers;
    }
}

?>