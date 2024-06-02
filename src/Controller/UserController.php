<?php

namespace App\Controller;

use App\Definitions\AbstractDefinitions;
use App\Entity\User;
use App\Service\UserService;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public IndexController $indexController;
    public EntityManagerInterface $em;

    public AbstractDefinitions $definitions;
    public UserService $userService;

    public function __construct(IndexController $indexController,
                                EntityManagerInterface $em,
                                AbstractDefinitions $abstractDefinitions,
                                UserService $userService)
    {
        $this->em = $em;
        $this->indexController = $indexController;
        $this->definitions = $abstractDefinitions;
        $this->userService = $userService;
    }

    /**
     * @throws Exception
     */
    #[NoReturn]
    #[Route('/{signUp}', name: 'signUp', requirements: ["signUp" => "(login|register)"])]
    public function loginPage(string $signUp, Request $request): Response
    {
        session_start();
        $params = $this->definitions::defineParams($request);
        $params = array_merge($params, ["page" => $signUp]);

        if (!empty($request->request->all())) {
            $requestParams = $request->request->all();
            $response = $this->userService->securityCheck($requestParams, $signUp);
            $error = !empty($response["error"]) ? $response["error"] : null;
            if (!empty($error)) {
                $params = array_merge($params, ["error" => $error]);
                return $this->render('user/signUp.html.twig', $params);
            } else {
                if ($signUp == 'register') {
                    $userId = $this->userService->setUser($requestParams);
                }
                else{
                    $userId = $response["userId"];
                }
                $_SESSION["userId"] = $userId;
                return $this->redirectToRoute('index');
            }
        }

        return $this->render('user/signUp.html.twig', $params);
    }

    #[NoReturn]
    #[Route('/logout', name: 'logout')]
    public function logout(Request $request): Response
    {
        $params = $this->definitions::defineParams($request);
        unset($params["user"]);
        session_unset();
        return $this->redirectToRoute('index');
    }


}