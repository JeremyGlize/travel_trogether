<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route ("/", name: "home")]
    public function home()
    {
        return $this->render('home.html.twig');
    }

//    #[Route ("/Politique de confidentialités", name: "Politique")]
//    public function Politique()
//    {
//        return $this->render('CGU/Politique.html.twig');
//    }
//
//    #[Route ("/Condition d'utilisation", name: "CGU")]
//    public function CGU()
//    {
//        return $this->render('CGU/CGU.html.twig');
//    }
}