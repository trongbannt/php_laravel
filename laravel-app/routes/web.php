<?php

use App\Http\Controllers\FoodsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;

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

Route::get('/home', function () {
    return view('home');
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

/*Pages */
Route::get("/", [
    PagesController::class,
    'index'
]);

Route::get("/about", [
    PagesController::class,
    'about'
]);

/*Posts */
Route::resource('/posts', PostsController::class);

/*Foods */
Route::resource('/foods',FoodsController::class);

// Route::get("/posts", [
//     PostsController::class,
//     'index'
// ])->name("posts");

// Route::get("/posts/create_post",[
//     PostsController::class,
//     'createPost'
// ])->name("create_post");


/*Route::get('/products', [
    ProductsController::class,
    'index' //index function of ProductsController
])->name('products');
*/

//how to validate "id only integer" ?
//Regular Expression
/*
Route::get('/products/{productName}/{id}', [
    ProductsController::class,
    'detail' 
])->where([
    'productName' => '[a-zA-Z0-9\s]+',
    'id' => '[0-9]+'
]);
*/
/*
Route::get('/products/{productName}', [
    ProductsController::class, 
    'detail' 
]);
 */

/*
Route::get('/products/about', [
    ProductsController::class,
    'about' 
]);
Route::get('/', function () {
    return view('home'); //response a view
    //return env('MY_NAME');
});
Route::get('/users', function () {
    return 'This is the users page';//response a string
});
//response an array 
Route::get('/foods', function () {
    return ['sushi', 'sashimi', 'tofu'];
});
//response an object
Route::get('/aboutMe', function () {
    return response()->json([
        'name' => 'Nguyen Duc Hoang',
        'email' => 'sunlight4d@gmail.com'
    ]); //response
});
//response another request = redirect
Route::get('/something', function () {
    return redirect('/foods');//redirect to foods
});
*/
