<?php

namespace App\Service;

use App\Definitions\Definitions;
use App\Entity\Country;
use App\Entity\Translations;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexService
{
    private ApiService $apiService;

    private EntityManagerInterface $em;

    public function __construct(ApiService $apiService, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->apiService = $apiService;
    }

    public function getWeatherData(string $countryAlias): array
    {
        $weatherData = $this->apiService->getWeatherApi($countryAlias);
        return [
            "weather" => strtolower($weatherData["weather"][0]["main"]),
            "temperature" => $this->convertKelvinToCelsius($weatherData["main"]["temp"]) . "°C",
            "location" => $weatherData["name"]
        ];
    }


    private function convertKelvinToCelsius(int $kelvinValue): float
    {
        return floor($kelvinValue - 272.15);
    }
}