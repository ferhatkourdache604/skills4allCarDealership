<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

class SearchCriteria 
{
    private $maxCost;

    private $carName;

    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function setCategories(ArrayCollection $categories)
    {
        $this->categories = $categories;
    }

    public function getCategories() : ArrayCollection
    {
        return $this->categories;
    }

    public function setCarName(?string $carName) 
    {
        $this->carName = $carName;
        return $this;
    }

    public function getCarName()
    {
        return $this->carName;
    }



    public function setMaxCost(?int $maxCost) 
    {
        $this->maxCost = $maxCost;
        return $this;
    }

    public function getMaxCost()
    {
        return $this->maxCost;
    }


}