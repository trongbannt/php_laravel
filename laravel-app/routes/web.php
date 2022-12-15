<?php

use App\Http\Controllers\FoodsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\BlogsController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

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


Route::get("/contact", [
    PagesController::class,
    'contact'
])->name('contact');


/*Posts */
Route::resource('/posts', PostsController::class)->middleware([
    'auth', 
]);


Route::middleware('auth')->group(function(){
    Route::get('/profile',[ProfilesController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilesController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/foods',FoodsController::class);
    Route::resource('/posts', PostsController::class);
});

// /**FE use vuejs */
Route::get('/',[PagesController::class,'index'])->name('home');
Route::get('/blog/food/{food_id}',[BlogsController::class,'index'])->name('blog.food');

require __DIR__.'/auth.php';

