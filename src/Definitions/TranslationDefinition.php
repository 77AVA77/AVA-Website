<?php

namespace App\Definitions;

use App\Entity\Translations;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class TranslationDefinition extends AbstractDefinitions
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public static function translations(string $country):array
    {
        $translationData = self::$em->createQueryBuilder()
            ->select('tr')
            ->from(Translations::class, 'tr')
            ->getQuery()->getArrayResult();
        $transData = [];
        foreach ($translationData as $translation){
            $transData[$translation['text']] = $translation["translations"][$country];
        }
        return $transData;
    }
    public static function define(array $params = []): array
    {
        return self::translations($params["selectedCountry"]);
    }

}