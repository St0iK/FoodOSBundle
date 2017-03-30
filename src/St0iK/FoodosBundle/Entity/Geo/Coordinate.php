<?php
namespace St0iK\FoodosBundle\Entity\Geo;

use Ivory\GoogleMap\Map;

class Coordinate
{
    private $latitude;
    private $longitude;

    public function __construct($latitude = null, $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
    public function __toString()
    {
        return '(' . $this->latitude . ', ' . $this->longitude . ')';
    }

    public static function createFromString($string)
    {
        if(strlen($string) < 1){
            return new self;
        }
        $string = str_replace(['(', ')', ' '], '', $string);
        $data = explode(',', $string);
        if($data[0] === "" || $data[1] === ""){
            return new self;
        }
        return new self($data[0], $data[1]);
    }

    public function toGmaps()
    {
        return new Map($this->latitude, $this->longitude);
    }
}