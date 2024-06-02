<?php

namespace App\Controller;

use App\Definitions\AbstractDefinitions;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    public EntityManagerInterface $em;

    public AbstractDefinitions $definitions;
    public function __construct(EntityManagerInterface $em, AbstractDefinitions $definitions)
    {
        $this->em = $em;
        $this->definitions = $definitions;

    }
    #[NoReturn]
    #[Route('/')]
    public function adminIndex(Request $request): Response
    {
        return $this->render('admin/index.html.twig', $this->definitions->defineParams($request));
    }

    #[NoReturn]
    #[Route('/tools')]
    public function adminTools(Request $request): Response
    {
        return $this->render('admin/index.html.twig', $this->definitions->defineParams($request));
    }

}