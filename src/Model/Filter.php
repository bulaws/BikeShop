<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

class Filter
{
    private $search;
    private $priceFrom;
    private $priceTo;
    private $price;

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearchProduct(?string $search): self
    {
        $this->search = $search;

        return $this;
    }

    public function getPriceFrom(): ?int
    {
        return $this->priceFrom;
    }

    public function setPriceFrom(?int $priceFrom): self
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    public function getPriceTo(): ?int
    {
        return $this->priceTo;
    }

    public function setPriceTo(?int $priceTo): self
    {
        $this->priceTo = $priceTo;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }
}