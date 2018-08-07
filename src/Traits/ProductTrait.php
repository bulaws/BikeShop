<?php

namespace App\Traits;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;

trait ProductTrait
{
    /**
     * Return one product from db
     *
     * @param int $id
     * @param EntityManager $doctrine
     * @return $product
     */

    public function getProduct($id, $doctrine)
    {
        $product = $doctrine
            ->getRepository(Product::class)
            ->find($id);
        return $product;

    }

}