<?php

namespace App\Definitions;

use App\Definitions\Definition\CountryDefinition;
use App\Definitions\Definition\Definitions;
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

    const IMAGEPATH = '/packages/images/';
    const FLAGIMAGEPATH1X1 = self::VENDORSPATH . 'flag-icon-css/flags/1x1/';
    const FLAGIMAGEPATH4X3 = self::VENDORSPATH . 'flag-icon-css/flags/4x3/';
    const VENDORSPATH = '/packages/vendors/';
    const FONTSPATH = '/packages/fonts/';

    const SIDEBAR = [
        'dashboard' => [
            'name' => 'Dashboard',
            'path' => '/',
            'icon' => 'speedometer',
            'subMenu' => [
                'subscriptions' => [
                    'path' => '/dashboard/subs',
                    'name' => 'Subscriptions'
                ],
                'main gadgets' => [
                    'path' => '/dashboard/gadgets',
                    'name' => 'Main Gadgets'
                ],
            ]
        ],
        'login' => [
            'name' => 'Login',
            'path' => '/login',
            'icon' => 'help',
        ],
        'pages' => [
            'name' => 'Pages',
            'path' => '/pages',
            'icon' => 'file-document-box',
        ],
        'users' => [
            'name' => 'Users',
            'path' => '/users',
            'icon' => 'contacts',
        ],
        'statistics' => [
            'name' => 'Statistics',
            'path' => '/statistics',
            'icon' => 'chart-bar',
        ],
        'ai-generation' => [
            'name' => 'AI Generation',
            'icon' => 'crop-portrait',
            'subMenu' => [
                'API calls' => [
                    'path' => '/ai/api',
                    'name' => 'API Calls'
                ],
                'images' => [
                    'path' => '/ai/images',
                    'name' => 'Images'
                ],
                'chatGPT'=> [
                    'path' => '/ai/chatgpt',
                    'name' => 'ChatGPT'
                ],
            ]
        ]
    ];

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

        $sidebarData = [
            'list' => self::SIDEBAR,
            'imagePath' => [
                'logo' => self::IMAGEPATH . 'logo.svg',
                'logo-mini' => self::IMAGEPATH . 'logo-mini.svg',
                'portfolio' => self::IMAGEPATH . 'faces/face1.jpg'
            ]
        ];
        $navbarData = [
            'languages' => CountryDefinition::defineParams($request, $params)["countries"],
            'imagePath' => [
                'portfolio' => self::IMAGEPATH . 'faces/face1.jpg',
                'person1' => self::IMAGEPATH . 'faces/face2.jpg',
                'person2' => self::IMAGEPATH . 'faces/face3.jpg',
                'person3' => self::IMAGEPATH . 'faces/face4.jpg',
            ]
        ];
        $params = array_merge($params, ['sidebar' => $sidebarData], ['navbar' => $navbarData]);

        return array_merge($params, CountryDefinition::defineParams($request, $params));
    }
}