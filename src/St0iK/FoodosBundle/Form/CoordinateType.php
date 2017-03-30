<?php

namespace St0iK\FoodosBundle\Form;

use Ivory\GoogleMap\Map;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoordinateType extends AbstractType
{
    protected $map;
    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $center = new \Ivory\GoogleMap\Base\Coordinate(39.91311850372953, 116.4002054820312);
        $this->map->setCenter($center);
        $this->map->setMapOption('zoom', 10);
        $view->vars['map'] = $this->map;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'widget' => 'coordinate',
                'compound' => false,
                'data_class' => 'St0iK\FoodosBundle\Entity\Geo\Coordinate'
            ]
        );
    }

}
