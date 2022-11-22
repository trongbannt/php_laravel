<?php

use App\Http\Controllers\FoodsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TestMiddlewareController;
use App\Http\Controllers\ProfilesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/welcome', function () {
    return view('welcome');
});


/*Products pages*/
Route::get("products", [
    ProductsController::class,
    "index" //index function of ProductsController
]);

Route::get("products/{name}", [
    ProductsController::class,
    "detail"
])->where("name", "[a-zA-Z0-9]+");

/*Pages home */
Route::get("/", [
    PagesController::class,
    'index'
]);

Route::get("/about", [
    PagesController::class,
    'about'
]);

Route::middleware(['role.test'])->group(function () {
    Route::get('/test', [
        TestMiddlewareController::class,
        'index'
    ]);
});

/*Posts */
Route::resource('/posts', PostsController::class)->middleware([
    'auth', 
    'verified'
]);

/*Foods */
Route::resource('/foods',FoodsController::class)->middleware([
    'auth', 
    'verified'
]);

Route::middleware('auth')->group(function(){
    Route::get('/profile',[ProfilesController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilesController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
