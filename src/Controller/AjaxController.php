<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class AjaxController extends AbstractController
{
    #[Route("/ajax/lang")]
    public function languageAjax(Request $request){

    }

}