<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function index(){

        return Inertia::render('Index');
        // return view("index");
    }

    public function about(){
        return view("about");
    }
}
