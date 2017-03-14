<?php
namespace St0iK\FoodosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $last_name;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
