<?php

namespace St0iK\FoodosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FoodosBundle:Default:index.html.twig');
    }
}
