<?php

namespace App\Definitions\Definition;

use App\Definitions\AbstractDefinitions;
use App\Definitions\DefinitionsInterface;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CountryDefinition extends AbstractDefinitions implements DefinitionsInterface
{
    const AVA_MAIN_LANGUAGE = "en";

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public static function getSelectedCountry(): string
    {
        $country = self::AVA_MAIN_LANGUAGE;
        if (!empty($_COOKIE["lang"])) {
            $country = $_COOKIE["lang"];
        }
        return $country;
    }

    public static function getCountries(): array
    {
        return self::$em->createQueryBuilder()
            ->select('c')
            ->from(Country::class, 'c')
            ->where("c.status = " . AbstractDefinitions::STATUS_ACTIVE)
            ->orderBy('c.id', 'ASC')
            ->getQuery()->getArrayResult();
    }

    public static function defineParams(Request $request, array $params = []): array
    {
        return [
            "country" => self::getSelectedCountry(),
            "countries" => self::getCountries()
        ];
    }


}