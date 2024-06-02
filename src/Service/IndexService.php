<?php

namespace App\Service;


class IndexService
{
    private ApiService $apiService;


    public function __construct(ApiService $apiService)
    {
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