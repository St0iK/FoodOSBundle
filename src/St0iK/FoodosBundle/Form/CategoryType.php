<?php

namespace St0iK\FoodosBundle\Form;

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
                    'attr' => array('data-parsley-minlength'=>'3')
            ))
            ->add('weight',null, array(
                'attr' => array(' data-parsley-type'=>'integer')
            ))
            ->add('description',null, array(
                'attr' => array('data-parsley-minlength'=>'30')
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'St0iK\FoodosBundle\Entity\Category'
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
