<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BlogsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/about", [
    PagesController::class,
    'about'
])->name('about');

Route::post("/blog/upload_image", [
    BlogsController::class,
    'uploadImage'
])->name('blog.uploadImage');

Route::post("/blog/remove_image", [
    BlogsController::class,
    'removeImage'
])->name('blog.removeImage');

Route::get("/blog/test_api", [
    BlogsController::class,
    'testApi'
])->name('blog.test_api');