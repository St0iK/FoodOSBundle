<?php

namespace St0iK\FoodosBundle\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/foodosbackend", name="foodosbackend")
     */
    public function indexAction()
    {
        return $this->render('@Foodos/Admin/Pages/index.html.twig');
    }
}
