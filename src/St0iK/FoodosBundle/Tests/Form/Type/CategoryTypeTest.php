<?php
namespace St0iK\FoodosBundle\Tests\Form\Type;

use St0iK\FoodosBundle\Form\CategoryType;
use St0iK\FoodosBundle\Entity\Category;
use Symfony\Component\Form\Test\TypeTestCase;

class TestedTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $title = "This is a test Title";
        $weight = 13;
        $description = "This is a test description";

        $formData = array(
            'title' => $title,
            'weight' => $weight,
            'description' => $description,
        );

        $form = $this->factory->create(CategoryType::class);
        $object = new Category();
        $object->setTitle($formData['title']);
        $object->setWeight($formData['weight']);
        $object->setDescription($formData['description']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}