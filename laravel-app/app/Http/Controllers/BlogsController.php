<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;
use Throwable;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Pagination\Paginator;
use App\Utilities\Constants;
use App\Http\Service\CategoryService;

class BlogsController extends Controller
{
    public function index($food_id)
    {
        $blog = Blog::with(['blogImages' => function ($query) {
                        $query->orderBy('order');
                    }])->where('food_id', $food_id)
                    ->orderByDesc('updated_at')
                    ->orderByDesc('created_at')
                    ->firstOrFail();

        $categories = CategoryService::getCategories();

        return Inertia::render('Blog/ShowBlog',['blog'=>$blog,'categories'=>$categories]);
    }
}
