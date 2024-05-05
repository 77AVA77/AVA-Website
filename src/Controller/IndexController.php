<?php

namespace App\Controller;

use App\Definitions\CountryDefinition;
use App\Definitions\AbstractDefinitions;
use App\Entity\Translations;
use App\Service\IndexService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public EntityManagerInterface $em;

    public IndexService $indexService;

    public AbstractDefinitions $definitions;
    public function __construct(EntityManagerInterface $em, IndexService $indexService, AbstractDefinitions $definitions)
    {
        $this->em = $em;
        $this->indexService = $indexService;
        $this->definitions = $definitions;

    }

    #[Route('/', name: 'index')]
    public function indexPage(Request $request): Response
    {
        $params = $this->defineParams($request);
        return $this->render('main.html.twig', $params);
    }

    public function defineParams(Request $request){
        $definitions = $this->definitions::define();
        $country = $definitions["country"]["selectedCountry"];
        $countries = $definitions["country"]["countries"];
        $weatherData = $this->indexService->getWeatherData($country);
        return [
            "countries" => $countries,
            "country" => $country,
            "translation" => $definitions["translation"],
            "baseUrl" => $request->getSchemeAndHttpHost(),
            "weatherData" => $weatherData
        ];
    }

}