<?php

namespace St0iK\FoodosBundle\Form;

use St0iK\FoodosBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',null, array(
                    'attr' => array(
                        'data-parsley-minlength'=>'3'
                    )
            ))
            ->add('weight',null, array(
                'attr' => array('
                    data-parsley-type'=>'integer'
                )
            ))
            ->add('description',null, array(
                'attr' => array(
                    'data-parsley-minlength'=>'30'
                )
            ))
            ->add('products',EntityType::class,array(
                'placeholder' => 'Assign Products to this category',
                'class' => Product::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => true
            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'St0iK\FoodosBundle\Entity\Category',
            'csrf_protection' => false // fix this
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st0ik_foodosbundle_category';
    }


}
