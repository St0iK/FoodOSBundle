<?php
namespace St0iK\FoodosBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Ivory\GoogleMap\Base\Coordinate;

class GeoTransformer implements DataTransformerInterface
{
    public function transform($geo)
    {
        return $geo;
    }

    public function reverseTransform($latlong)
    {
        return Coordinate::createFromString($latlong);
    }
}