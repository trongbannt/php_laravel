<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Throwable;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Pagination\Paginator;
use App\Utilities\Constants;
use App\Http\Service\CategoryService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class FoodsController extends Controller
{

    public function index(Request $request)
    {
        try {

            $currentPage = 1;
            $query = Food::with('category:id,name');
            if ($request->has('page')) {
                // You can set this to any page you want to paginate to
                $currentPage = $request->query('page');
            }

            // Make sure that you call the static method currentPageResolver()
            // before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $filter = "";
            if ($request->has('filter')) {
                $filter = $request->query('filter');
                $query = $query->where('name', 'like', "%" . $filter . "%");
            }

            $foodsPaging = $query->orderByDesc('updated_at')
                ->orderByDesc('created_at')
                ->Paginate(Constants::PAGE_SIZE);

            return Inertia::render('Food/ListFood', ['foods' => $foodsPaging]);
            //return view('foods.index', ['foods' => $foodsPaging]);
            //return response()->json(['foods' => $foodsPaging]);

        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception);
            throw $exception;
        }
    }

    public function create(Request $request)
    {
        
        $this->authorize('create',Food::class);

        $categories = CategoryService::getCategories();

        return Inertia::render('Food/CreateFood', ['categories' => $categories]);
        // return view('foods.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            
            $this->authorize('create',Food::class);

            // validate data request
            $request->validate([
                "name" => ['required', 'max:255', Rule::unique(Food::class)],
                "count" => ['required', 'integer', 'min:0', 'max:1000'],
                "category_id" => ['required'],
                'image' => ['required', 'image', 'max:5048']
            ]);

            // //client image's name and server's image name
            // //must be different, why ??
            $image_path = $this->generatedImageName($request->image);

            //if the validation is pass, it will create object food new
            $foodAdd = Food::create([
                'name' => $request->name,
                'count' => $request->count,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image_path' => $image_path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::channel('log_app')->info('CREATED', ['Food' => $foodAdd]);
            //save data to database
            $foodAdd->save();

            return Redirect('/foods')->with(Constants::MESSAGE, "Created food success!");
        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function edit($id)
    {
        try {
            $this->authorize('update',Food::class);
            $foodEdit = Food::findOrFail($id);
            $categories =  CategoryService::getCategories();

            return Inertia::render('Food/EditFood', ['categories' => $categories, 'food' => $foodEdit]);
            //return view('foods.edit', ['categories' => $categories, 'food' => $foodEdit]);
        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->authorize('update',Food::class);
            $food = Food::findOrFail($id);
            $image_path  = $request->image_path;
            if ($request->hasFile('image')) {
                // validate data request if has file image
                $request->validate([
                    "name" => ['required', 'max:255', Rule::unique(Food::class)->ignore($food->id)],
                    "count" => ['required', 'integer', 'min:0', 'max:1000'],
                    "category_id" => ['required'],
                    //Validate image
                    'image' => ['required', 'image', 'max:5048']
                ]);

                //client image's name and server's image name
                //must be different, why ??
                $image_path = $this->generatedImageName($request->image);
            } else {
                // validate data request if has not file image
                $request->validate([
                    "name" => ['required', 'max:255', Rule::unique(Food::class)->ignore($food->id)],
                    "count" => ['required', 'integer', 'min:0', 'max:1000'],
                    "category_id" => ['required'],
                ]);
            }

            $food->name = $request->name;
            $food->count = $request->count;
            $food->category_id = $request->category_id;
            $food->description = $request->description;
            $food->image_path = $image_path;
            $food->save();

            Log::channel('log_app')->info('UPDATED', ['Food' => $food]);

            return Redirect('/foods')->with(Constants::MESSAGE, "Modify food success!");
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function destroy($id)
    {
        try {
            
            $this->authorize('delete',Food::class);
            $foodDelete = Food::findOrFail($id);
            $foodDelete->delete();
            Log::channel('log_app')->info('DELETED', ['Food' => $foodDelete]);
            return back()->with(Constants::MESSAGE, "Delete food success!");
        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function show($id)
    {
        try {
            $food = Food::with('category:name')->findOrFail($id);
            return Inertia::render('Food/ShowFood', ['food' => $food]);
            // return view('foods.detail')->with('food', $food);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }


    /**Function support */
    private function generatedImageName($image)
    {
        //client image's name and server's image name
        //must be different, why ??
        $ext =  $image->extension();
        $generatedImageName = 'food/image' . '-' . date('Ymd') . '-' . time() . '.' . $ext;

        //move to a folder
        $image->move(public_path('images/food'), $generatedImageName);
        return $generatedImageName;
    }
    /**End Function support */
}
