<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace St0iK\FoodosBundle\Repository;

use St0iK\FoodosBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class CategoryRepository extends EntityRepository
{

    public function findAllSortedByWeight()
    {
        return $this->findBy(array(), array('weight' => 'ASC'));
    }

}
