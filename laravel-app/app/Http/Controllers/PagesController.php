<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Inertia\Inertia;
use Illuminate\Pagination\Paginator;
use App\Utilities\Constants;
use App\Http\Service\CategoryService;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $currentPage = 1;
        $category_id = "";
        $filter = "";
        $query = Food::query();
       
        if ($request->has('page')) {
            // You can set this to any page you want to paginate to
            $currentPage = $request->query('page');
        }

        // Make sure that you call the static method currentPageResolver()
        // before querying users
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        if ($request->has('filter')) {
            $filter = $request->query('filter');
            $query = $query->where('name', 'like', "%" . $filter . "%");
        }

        if ($request->has('category')) {
            $category_id = $request->query('category');
            $query = $query->where('category_id', $category_id);
        }

        $foodsPaging = $query->orderByDesc('updated_at')
                            ->orderByDesc('created_at')
                            ->Paginate(Constants::PAGE_SIZE_HOME);

        $categories = CategoryService::getCategories();
        return Inertia::render('Index', ['foods' => $foodsPaging, 'categories' => $categories]);
    }

    public function about()
    {
        $data = DB::table('foods')
            ->join('categories', 'foods.category_id', '=', 'categories.id')
            ->select(['foods.id', 'foods.name', 'foods.count', 'categories.name as category'])
            ->orderBy('count', 'DESC')

            ->get();


        $data_1 = DB::table('foods')
            ->where('foods.id', '<=', '5')
            ->get();

        $data_2 = DB::table('foods')
            ->where('foods.id', '<=', '8')
            ->get();

        $data_3 = $data_1->union($data_2);

        //dd($data);

        //return Inertia::render('About', ['data' => $data]);
        return response()->json(['data_1' => $data_1, 'data_2' => $data_2, 'data3' => $data_3]);
    }

    public  function contact()
    {
       return Inertia::render("Contact");
    }
}
