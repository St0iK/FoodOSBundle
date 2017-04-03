<?php

namespace St0iK\FoodosBundle\Form;

use St0iK\FoodosBundle\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductIngredientsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredient',EntityType::class,array(
                'placeholder' => 'Assign Products to this category',
                'class' => Ingredient::class,
                'choice_label' => 'title'
            ))->add('price');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'St0iK\FoodosBundle\Entity\ProductIngredients'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st0ik_foodosbundle_productingredients';
    }


}
