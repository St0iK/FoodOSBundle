<?php

namespace St0iK\FoodosBundle\Form;

use Geocoder\Provider\FreeGeoIp;
use Geocoder\Provider\GoogleMaps;
use Ivory\GoogleMap\Base\Coordinate as GoogleMapCoordinate;
use Ivory\GoogleMap\Map;
use St0iK\FoodosBundle\Entity\Geo\Coordinate;
use St0iK\FoodosBundle\Form\Transformer\GeoTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\GoogleMap\Event\Event;

class CoordinateType extends AbstractType
{
    protected $map;
    protected $geoIpGeocoder;
    private $mapFieldKey = 'map';

    public function __construct(Map $map, FreeGeoIp $geoIpGeocoder)
    {
        $this->map = $map;
        $this->geoIpGeocoder = $geoIpGeocoder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(new GeoTransformer());

        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($builder) {
                $data = $event->getData();
                if (null === $data->getLatitude()) {
                    $geoCoded = $this->geoIpGeocoder->geocode('156.67.242.17')->first();
                    $value = new Coordinate($geoCoded->getLatitude(),$geoCoded->getLongitude());
                    $event->setData($value);
                }
        });

        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        $center = new GoogleMapCoordinate(
            $form->getData()->getLatitude(),
            $form->getData()->getLongitude()
        );
        $this->map->setCenter($center);
        $this->map->setMapOption('zoom', 10);
        $this->map->setStylesheetOption('width', '300px');
        $this->map->setStylesheetOption('height', '300px');



        /**
         * Add an onclick Event
         * To pick the location
         */
        $event = new Event(
            $this->map->getVariable(),
            'click',
            'function(event){
                $( "input[name*=\'[' . $this->mapFieldKey . ']\']" ).val(event.latLng);
                var marker = new google.maps.Marker({
                    position: event.latLng, 
                    map: '.$this->map->getVariable().'
                });
                
            }'
        );
        $this->map->getEventManager()->addDomEvent($event);
        $view->vars[$this->mapFieldKey] = $this->map;
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
                'data_class' => 'St0iK\FoodosBundle\Entity\Geo\Coordinate',
                'data' => new Coordinate(),
            ]
        );
    }

    public function getParent()
    {
        return HiddenType::class;
    }

}
