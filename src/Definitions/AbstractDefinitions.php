<?php

namespace App\Definitions;

use App\Definitions\Definition\CountryDefinition;
use App\Definitions\Definition\TranslationDefinition;
use App\Definitions\Definition\UserDefinition;
use App\Service\IndexService;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;

class AbstractDefinitions
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    const ROLES = [
        self::ROLE_ADMIN => "admin",
        self::ROLE_USER => "user"
    ];

    protected static EntityManagerInterface $em;

    protected static IndexService $indexService;

    public function __construct(EntityManagerInterface $em, IndexService $indexService = null)
    {
        self::$em = $em;
        self::$indexService = $indexService;
    }

    #[NoReturn]
    public static function defineParams(Request $request, array $params = []): array
    {
        // @TODO: Optimization

        $user = UserDefinition::defineParams($request, $params);

        $country = CountryDefinition::defineParams($request, $params)["country"];
        $params = [
            "translation" => TranslationDefinition::translations($country),
            "baseUrl" => $request->getSchemeAndHttpHost(),
            "weatherData" => self::$indexService->getWeatherData($country)
        ];
        if(!empty($user)){
            $params = array_merge($params, [
                "user" => [
                    "name" => $user["name"] . " " . $user["surname"],
                    "role" => self::ROLES[$user["role"]]
                ]
            ]);
        }

        return array_merge($params, CountryDefinition::defineParams($request, $params));
    }
}