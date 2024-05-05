<?php

namespace App\Controller;

use App\Definitions\Definitions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public IndexController $indexController;

    public EntityManagerInterface $em;

    public function __construct(IndexController $indexController, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->indexController = $indexController;
    }

    #[Route('/{signUp}', name: 'signUp', requirements:["signUp" => "(login|register)"])]
    public function loginPage(string $signUp, Request $request):Response{
        $initialParams = $this->indexController->defineParams($request);

        $params = array_merge($initialParams, ["signUp" => true]);
        if ($signUp == 'login') {
            $this->em->createQueryBuilder();
            $params = array_merge($params, ["login" => true]);
        } elseif ($signUp == 'register') {
            $params = array_merge($params, ["register" => true]);
        }
        if(!empty($request->request->all())) {
            $requestParams = $request->request->all();
            $response = $this->securityCheck($requestParams, $signUp);
            $error = $response["error"] ?? "";
            if (!empty($error)) {
                $params = array_merge($params, ["error" => $error]);
                return $this->render('user/signUp.html.twig', $params);
            } else {
                if($signUp == 'register'){
                    $this->setUser($requestParams);
                }
                unset($params["login"]);
                unset($params["register"]);
                unset($params["signUp"]);
                return $this->render('main.html.twig', $params);
            }
        }


        return $this->render('user/signUp.html.twig', $params);
    }

    protected function setUser($requestParams){
        $sql = "INSERT INTO public.user (name, surname, email, password, role) VALUES 
                ('{$requestParams['name']}', '{$requestParams['surname']}', '{$requestParams['email']}', '" . md5($requestParams["password"]) . "'," . Definitions::ROLE_USER . ")";
        $this->em->getConnection()->executeQuery($sql);
    }

    protected function securityCheck(array $user, string $page):array
    {
        $error = "";
        $email = $user["email"];
        $password = $user["password"];

        if($page == 'login'){
            // check all user params
        }


        if($page == "register") {
            if (isset($user["name"])) {
                $name = $user["name"];
                if (empty($name)) {
                    $error = "Name is empty.";
                } elseif (strlen($name) < 8) {
                    $error = "Name characters must be over than 8.";
                } elseif (strlen($name) > 25) {
                    $error = "Name characters must be less than 2.5";
                }
            }

            if (isset($user["surname"])) {
                $surName = $user["name"];
                if (empty($surName)) {
                    $error = "Surname is empty.";
                } elseif (strlen($surName) < 8) {
                    $error = "Surname characters must be over than 8.";
                } elseif (strlen($surName) > 25) {
                    $error = "Surname characters must be less than 2.5";
                }
            }
            // if user exists

        }
        if(empty($email) || empty($password)){
            $error = "Empty Email or Password.";
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid Email address.";
        }
        elseif(strlen($password) < 8){
            $error = "Password characters must be over than 8.";
        }
        elseif (strlen($password) > 25){
            $error = "Password characters must be less than 2.5";
        }

        if(!empty($error)){
            $error .= " Please fill the form again";
        }

        return ["error" => $error];



    }


}