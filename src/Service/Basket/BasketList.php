<?php

namespace App\Service\Basket;

use App\Traits\ProductTrait;
use Doctrine\ORM\EntityManager;


class BasketList
{
    use ProductTrait;

    public function BasketList($productsIdList, $doctrine)
    {
        $basketList = [];
        if (!empty($productsIdList)) {
            foreach ($productsIdList as $id => $value) {

                $basketList[] = $this->getProduct($id, $doctrine);
            }
        }
        return $basketList;

    }
}