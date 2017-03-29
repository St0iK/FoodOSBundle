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
    /**
     * @return mixed
     */
    public function findAllSortedByWeight()
    {
        return $this->createQueryBuilder('cat')
            ->orderBy('cat.weight')
            ->leftJoin('cat.products', 'pr')
            ->addSelect('pr')
            ->getQuery()->getArrayResult();
    }

    /**
     * Returns the last inserted category
     * @return mixed
     */
    function getLastEntity()
    {
        return $this->createQueryBuilder('e')->
        orderBy('e.created', 'DESC')->
        setMaxResults(1)->
        getQuery()->
        getOneOrNullResult();
    }

}
