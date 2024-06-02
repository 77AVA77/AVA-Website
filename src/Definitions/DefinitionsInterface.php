<?php

namespace App\Definitions;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

interface DefinitionsInterface
{

    public function __construct(EntityManagerInterface $em);
    public static function defineParams(Request $request, array $params = []):array;
}