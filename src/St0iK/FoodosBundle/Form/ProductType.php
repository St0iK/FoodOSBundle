<?php

namespace St0iK\FoodosBundle\Form;

use St0iK\FoodosBundle\Entity\Category;
use St0iK\FoodosBundle\Entity\Ingredient;
use St0iK\FoodosBundle\Entity\ProductIngredients;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('weight')
            ->add('description')
            ->add('price')
            ->add('categories',EntityType::class,array(
                'placeholder' => 'Please select Category',
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'title'
            ))
            ->add('ingredients',CollectionType::class,array(
                'entry_type' => IngredientType::class
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'St0iK\FoodosBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st0ik_foodosbundle_product';
    }


}
