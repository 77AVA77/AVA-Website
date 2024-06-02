<?php

namespace App\Definitions\Definition;

use App\Definitions\AbstractDefinitions;
use App\Definitions\DefinitionsInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserDefinition extends AbstractDefinitions implements DefinitionsInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);
    }

    public static function getSignedUserData():array
    {
        if(self::checkSession(isset($_SESSION["userId"])) !== true){
            return [];
        }

        return self::$em->createQueryBuilder()->select('u.name, u.surname, u.role')
            ->from(User::class, 'u')
            ->where("u.id = {$_SESSION['userId']}")
            ->getQuery()->getArrayResult();

    }


    public static function checkSession(bool $issetSession):bool
    {
        if(!$issetSession) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $issetSession = isset($_SESSION["userId"]);
        }
        return $issetSession;
    }

    public static function defineParams(Request $request, array $params = []): array
    {
        return self::getSignedUserData()[0] ?? self::getSignedUserData();
    }

}