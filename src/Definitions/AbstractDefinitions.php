<?php

namespace App\Definitions;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AbstractDefinitions
{
    protected static EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        self::$em = $em;
    }

    public static function define(array $params = []) : array
    {
        $country = CountryDefinition::define();
        return [
            "country" => $country,
            "translation" => TranslationDefinition::define($country)
            ];
    }

}