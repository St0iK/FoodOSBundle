<?php

namespace St0iK\FoodosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use St0iK\FoodosBundle\Entity\Ingredient;
use St0iK\FoodosBundle\Entity\Product;

/**
 * ProductIngredients
 *
 * @ORM\Table(name="product_ingredients")
 * @ORM\Entity(repositoryClass="St0iK\FoodosBundle\Repository\ProductIngredientsRepository")
 */
class ProductIngredients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ingredient",inversedBy="ingredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    /**
     * @ORM\Column(type="decimal", nullable=true, precision=7, scale=2)
     */
    protected $price = 0;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param mixed $ingredient
     */
    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}

