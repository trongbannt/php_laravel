<?php

namespace App\Http\Service;

use App\Models\Category;

class CategoryService 
{

    public static function getCategories()
    {
        $categories = Category::select('id','name')->get();
        return $categories;
    }
}
