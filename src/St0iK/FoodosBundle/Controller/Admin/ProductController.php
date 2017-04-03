<?php

namespace St0iK\FoodosBundle\Controller\Admin;
use St0iK\FoodosBundle\Entity\Category;
use St0iK\FoodosBundle\Entity\Ingredient;
use St0iK\FoodosBundle\Entity\Product;
use St0iK\FoodosBundle\Entity\ProductIngredients;
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

        $product = new Product();
        $ingredient_1 = new Ingredient();
        $ingredient_1->setTitle('Ingredient 1');
        $ingredient_1->setDescription('Lorem ipsum and some other stuff for the description');
        $product->setIngredients($ingredient_1);



        $form = $this->createForm(ProductType::class,$product);

        return $this->render('@Foodos/Admin/Pages/product.html.twig',
            [
                'products' => $products,
                'form' => $form->createView()
            ]
        );

    }

}
