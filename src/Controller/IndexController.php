<?php

namespace App\Controller;

use App\Definitions\AbstractDefinitions;
use App\Service\IndexService;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
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

    #[NoReturn]
    #[Route('/', name: 'index')]
    public function indexPage(Request $request): Response
    {
        return $this->render('/base/main.html.twig', $this->definitions::defineParams($request));
    }
}