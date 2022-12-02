<?php

namespace App\ViewModel;

class FoodViewModel
{
    function __construct($name, $count,$description,$category) {
        $this->name = $name;
        $this->count = $count;
        $this->description = $description;
        $this->category = $category;
      }
    // Properties
    public $name;
    public $count;
    public $description;
    public $category;
}
