<?php
namespace St0iK\FoodosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="St0iK\FoodosBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinTable(
     *     name="product_category",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     *
     */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="St0iK\FoodosBundle\Entity\ProductIngredients", mappedBy="ingredient")
     */
    protected $ingredients;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank
     */
    private $weight;


    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", nullable=true, precision=7, scale=2)
     */
    protected $price = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients[] = $ingredients;
    }


    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Product
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add categories
     *
     * @param \St0iK\FoodosBundle\Entity\Category $category
     * @return Product
     */
    public function addCategory(\St0iK\FoodosBundle\Entity\Category $category)
    {
        if($this->categories->contains($category)){
            return;
        }
        $this->categories[] = $category;
        // This is not needed for persistance
        // Can save us on some edge cases. That During the same request
        // We set a Product to a Category and then we to a getProducts on a category
        // Makes sure that both sides of the relationship stay synchronised
        $category->addProduct($this);
        return $this;
    }


    public function addIgredient(\St0iK\FoodosBundle\Entity\Ingredient $ingredient)
    {
        if($this->ingredients->contains($ingredient)){
            return;
        }
        $this->ingredients[] = $ingredient;
        // This is not needed for persistance
        // Can save us on some edge cases. That During the same request
        // We set a Product to a Category and then we to a getProducts on a category
        // Makes sure that both sides of the relationship stay synchronised
//        $ingredient->addProduct($this);
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \St0iK\FoodosBundle\Entity\Category $category
     */
    public function removeCategory(\St0iK\FoodosBundle\Entity\Category $category)
    {
        if(!$this->categories->contains($category)){
            return;
        }
        $this->categories->removeElement($category);
        $category->removeProduct($this);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
