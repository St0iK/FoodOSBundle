<?php

namespace St0iK\FoodosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $notify = $this->container->get('stoik.notify');
        $notify->add("test", array("type" => "instant", "message" => "This is awesome"));

        if ($notify->has("test")) {
            $return = array("notifications" => $notify->get("test"));
        }else{
            $return =  array();
        }

        dump($return);
        $repository = $this->getDoctrine()->getRepository('FoodosBundle:Category');
        $categories = $repository->findAllSortedByWeight();

        foreach ($categories as $category) {
            foreach ($category->getProducts() as $product) {
                echo "<br>".$product->getTitle();
            }
        }

        $geoCoder = $this->container->get('google_maps_geocoder');
        $geocodedData = $geoCoder->geocode('14 Westpoint, LS14JJ');
        return $this->render('FoodosBundle:Default:index.html.twig');
    }
}
