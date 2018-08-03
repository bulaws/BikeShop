<?php

namespace App\Model;


class Filter
{
    private $searchProduct;
    private $priceFrom;
    private $priceTo;
    private $price;


    public function getSearchProduct(): ?string
    {
        return $this->searchProduct;
    }

    public function setSearchProduct(?string $searchProduct): self
    {
        $this->searchProduct = $searchProduct;

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

    /**
     * @return mixed
     */
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