<?php

namespace App\Controller;

use App\Definitions\AbstractDefinitions;
use App\Definitions\Definition\Definitions;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AjaxController extends AbstractController
{
    public AbstractDefinitions $definitions;

    public function __construct(AbstractDefinitions $definitions)
    {
        $this->definitions = $definitions;
    }

    #[NoReturn] #[Route('/uiAjax', name: 'ui_ajax', methods: ['POST'])]
    public function uiTemplateAjax(Request $request):JsonResponse
    {
        return new JsonResponse($this->definitions::defineParams($request));

    }
}