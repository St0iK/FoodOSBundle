<?php

namespace St0iK\FoodosBundle\Controller\Admin;
use St0iK\FoodosBundle\Entity\Category;
use St0iK\FoodosBundle\Form\CategoryType;
use St0iK\FoodosBundle\Services\Utilities\FormErrorsSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('@Foodos/Admin/Pages/index.html.twig');
    }

    public function catalogAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        /* @var \St0iK\FoodosBundle\Repository\CategoryRepository $categoryRepository*/
        $categoryRepository = $entityManager->getRepository(Category::class);
        $categories = $categoryRepository->findAllSortedByWeight();

        $form = $this->createForm(CategoryType::class);

        return $this->render('@Foodos/Admin/Pages/catalog.html.twig',
            [
                'categories' => json_encode($categories),
                'form' => $form->createView()
            ]
        );
    }

    public function ajaxCategoryAddAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);
        //print_r( $request->request->all());exit;
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $serializer = $this->container->get('jms_serializer');

            return new JsonResponse(array(
                'message' => 'Success!',
                'category' => $serializer->serialize($category, 'json')
            ), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'errors' => $this->container->get('form_serializer')->serializeFormErrors($form)
        ), 400);

        return $response;
    }

    public function ajaxCategoryEditAction(Request $request, Category $category)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $serializer = $this->container->get('jms_serializer');
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
            return new JsonResponse(array(
                'message' => 'Update Success!',
                'category' => $serializer->serialize($category, 'json')
            ), 200);
        }

        $response = new JsonResponse(
            array('category' => $serializer->serialize($category, 'json')
            ), 200);

        return $response;
    }


}
