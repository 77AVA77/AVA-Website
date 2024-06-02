<?php

namespace App\Service;

use App\Entity\Api;
use App\Entity\Country;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\Config\Definition\Exception\Exception;

class ApiService
{
    public Client $client;

    private EntityManagerInterface $em;

    public function __construct(Client $guzzleClient, EntityManagerInterface $em)
    {
        $this->client = $guzzleClient;
        $this->em = $em;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function getWeatherApi($countryAlias):array
    {
        $weatherApi = $this->em->createQueryBuilder()
            ->select('api')
            ->from(Api::class, 'api')
            ->where("api.name = 'weather_" . $countryAlias . "'")
            ->getQuery()->getArrayResult();
        $weatherApi = $weatherApi[0] ?? $weatherApi;

        $currentCountryCapital = $this->em->createQueryBuilder()->
        select('c.capital')
            ->from(Country::class, 'c')
            ->where("c.alias = '$countryAlias'")
            ->getQuery()->getArrayResult()[0]["capital"];

        if (!empty($weatherApi)) {
            $apiId = $weatherApi["id"];
            $updatedAt = $weatherApi["updated_at"];
//                $weatherData = json_encode($this->getWeatherData($currentCountryCapital));
//                $this->em->createQueryBuilder()->update(Api::class, 'api')
//                    ->set('api.updated_at', ':date')
//                    ->set("api.value", ':data')
//                    ->where("api.id = $apiId")
//                    ->setParameter('data', $weatherData)
//                    ->setParameter('date', $dateTime)
//                    ->getQuery()->execute();
        } else {
            $date = new DateTime();
            $dateTime = $date->format('Y-m-d h:i:s');
            $weatherData = json_encode($this->getWeatherData($currentCountryCapital));
            $this->em->getConnection()->executeQuery(
                "INSERT INTO api (name, value, created_at, updated_at)
                        VALUES ('weather_" . $countryAlias .  "', '$weatherData', '$dateTime', '$dateTime')"
            )->fetchAllAssociative();
        }
        return !empty($weatherData) ? json_decode($weatherData, true) :$weatherApi["value"];
    }

    protected function getWeatherData(string $city){

        $options = [
            'appid' => '254aacacec43c9cccc92d4936d8624d9',
            'q' => $city,
            'units' => 'current',
            'lang' => 'en'
        ];

        $queryString = http_build_query($options);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.openweathermap.org/data/2.5/weather?' . $queryString,
            CURLOPT_RETURNTRANSFER => true, // Return the response instead of outputting it
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            throw new Exception("Error occured while calling weather api: " .  $error);
        }

        return json_decode($response, true);
    }

}