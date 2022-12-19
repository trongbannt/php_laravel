<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Food;
use App\Models\BlogImage;
use Throwable;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Pagination\Paginator;
use App\Utilities\Helper;
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

        return Inertia::render('Blog/ShowBlog', ['blog' => $blog, 'categories' => $categories]);
    }

    public function create($food_id)
    {
        $blog = Blog::where('food_id', $food_id)->first();
        $food = Food::findOrFail($food_id);

        return Inertia::render('Blog/CreateBlog', ['food' => $food, 'blog' => $blog]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5048']
        ]);

        $folderDestination = "images/blog/details";
        $food_id = $request->food_id;
        $prefixImageName = "blog/details/detail-" . $food_id;

        $image_path = Helper::generatedImageName($request->image, $folderDestination, $prefixImageName);

        $data = (object) [
            'url' => route('home') . "/images/" . $image_path,
            'image_path' => $image_path
        ];

        return response()->json($data);
    }

    public function removeImage(Request $request)
    {
        $image = $request->image;
        $index = stripos($image, "images");
        if ($index < 0) {
            $data = (object) [
                "message" => "Don't get path image"
            ];
            return response()->json($data);
        }

        $image_path = substr($image, $index);
        if (!unlink($image_path)) {
            $data = (object) [
                "message" => "The file " . $image_path . " does not exist"
            ];
            return response()->json($data);
        }

        $data = (object) [
            "message" => "The file " . $image_path . " has been deleted"
        ];
        return response()->json($data);
    }

    public function testApi(Request $request)
    {

        $request->validate([
            'image' => ['required', 'image', 'max:5048']
        ]);

        $folderDestination = "images/blog/details";
        $prefixImageName = "blog/details/detail";

        $image_path = Helper::generatedImageName($request->image, $folderDestination, $prefixImageName);

        $data = (object) [
            'url' => route('home') . "/images/" . $image_path,
        ];

        return response()->json($data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'food_id' => ['required']
        ]);

        $blog_id = "";
        if ($request->has('id')) {
            // You can set this to any page you want to paginate to
            $blog_id = $request->id;
            $blog = Blog::findOrFail($blog_id);
            $blog->name = $request->name;
            $blog->content = $request->content;
            $blog->save();
            return back()->with(["success" => "Save content blog for product success"]);
        }

        $blog = Blog::create([
            "name" => $request->name,
            "food_id" => $request->food_id,
            "content" => $request->content
        ]);
        $blog->save();

        return back()->with(["success" => "Save content blog for product success"]);
    }
}
