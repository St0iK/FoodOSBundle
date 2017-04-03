<?php

namespace St0iK\FoodosBundle\Controller\Admin;
use St0iK\FoodosBundle\Entity\Category;
use St0iK\FoodosBundle\Entity\Product;
use St0iK\FoodosBundle\Form\CategoryType;
use St0iK\FoodosBundle\Form\CoordinateType;
use St0iK\FoodosBundle\Form\ProductType;
use St0iK\FoodosBundle\Services\Utilities\FormErrorsSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ProductController extends Controller
{

    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* @var \St0iK\FoodosBundle\Repository\CategoryRepository $categoryRepository*/
        $productRepository = $entityManager->getRepository(Product::class);
        $products = $productRepository->findAll();
        $form = $this->createForm(ProductType::class);

        return $this->render('@Foodos/Admin/Pages/product.html.twig',
            [
                'products' => $products,
                'form' => $form->createView()
            ]
        );

    }

}
