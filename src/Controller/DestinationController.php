<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    #[Route ("/destinations", name: "destination")]
    public function destination()
    {
        return $this->render('destination.html.twig');
    }

}