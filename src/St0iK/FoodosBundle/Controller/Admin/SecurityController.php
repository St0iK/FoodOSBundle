<?php
/**
 * Created by PhpStorm.
 * User: jimstoik13
 * Date: 01/03/2017
 * Time: 14:24
 */

namespace St0iK\FoodosBundle\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class SecurityController extends  Controller
{
    /**
     * @Route("/foodosbackend/login", name="foodosbackend_login")
     */
    public function loginAction(Request $request)
    {
        echo "xaxaxa";exit;
    }
}