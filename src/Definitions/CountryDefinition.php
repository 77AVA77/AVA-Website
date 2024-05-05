<?php

namespace App\Definitions;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CountryDefinition extends AbstractDefinitions
{
const AVA_MAIN_LANGUAGE = "en";

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

public static function getCountry():string
{
    $country = self::AVA_MAIN_LANGUAGE;
    if(!empty($_COOKIE["lang"])){
        $country = $_COOKIE["lang"];
    }
    return $country;
}

public static function getCountries():array
{
    return self::$em->createQueryBuilder()
        ->select('c')
        ->from(Country::class, 'c')
        ->where("c.status = " . Definitions::STATUS_ACTIVE)
        ->orderBy('c.id', 'ASC')
        ->getQuery()->getArrayResult();
}

public static function define(array $params = []):array
{
    return [
        "selectedCountry" => self::getCountry(),
        "countries" => self::getCountries()
    ];

}

}