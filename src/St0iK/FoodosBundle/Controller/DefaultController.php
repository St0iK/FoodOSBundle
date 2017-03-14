<?php

namespace St0iK\FoodosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('FoodosBundle:Category');
        $categories = $repository->findAllSortedByWeight();
        
//        foreach ($categories as $category) {
//            foreach ($category->getProducts() as $product) {
//                echo "<br>".$product->getTitle();
//            }
//        }
        exit;
        return $this->render('FoodosBundle:Default:index.html.twig');
    }
}
