<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestMiddlewareController extends Controller
{
    public function index(){
        echo "<br>Test TestMiddleware Controller page index";
    }
}
