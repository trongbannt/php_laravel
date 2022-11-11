<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //send a associative array
    public $dataPhone = [
        [
            "name" => "Iphone 14",
            "year" => "2022",
            "price" => "600$",
        ],

        [
            "name" => "samsung",
            "year" => "2021",
            "price" => "400$",
        ],

    ];
    public function index()
    {
        //return view("products.index");
       

        //return print_r($dataPhone);
        $phones = $this->dataPhone;
        return view("products.index", ["dataPhone" => $phones]);
    }

    public function detail($name)
    {
        //return "Detail Product name-".$name;
        $phones = $this->dataPhone;
        $phoneDetail=[];
        foreach ($phones as $item => $phone) {
            if ($phone["name"] == $name) {
                $phoneDetail = $phone;
                break;
            }
        }
        print_r($phoneDetail);
        //return "Detail Product ".$phoneDetail;
        // return view("products.detail",["dataPhone" => $phoneDetail]);
    }
}
