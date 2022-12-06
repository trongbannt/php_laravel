<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use Throwable;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Pagination\Paginator;

class FoodsController extends Controller
{
    public int $pageSize = 10;

    public function index(Request $request)
    {
        try {

            $currentPage = 1;
            if ($request->has('page')) {
                // You can set this to any page you want to paginate to
                $currentPage = $request->query('page');
                //dd($request);
            }

            // Make sure that you call the static method currentPageResolver()
            // before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $foodsPaging = Food::Paginate($this->pageSize);

            foreach ($foodsPaging as $item) {
                $item->category->name;
            }

            return Inertia::render('Food/ListFood', ['foods' => $foodsPaging]);
            //return view('foods.index', ['foods' => $foodsPaging]);
            //return response()->json(['foods' => $foodsPaging]);

        } catch (Throwable $exception) {

            // dd($exception);
            Log::channel('log_app')->error($exception);
            throw $exception;
        }
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('foods.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            dd($request);
            // validate data request
            $request->validate([
                "name" => "required|unique:foods|max:255",
                "count" => "required|integer|min:0|max:1000",
                "category_id" => "required",
                'image' => 'required|mimes:jpg,png,jpeg|max:5048'
            ]);

            //client image's name and server's image name
            //must be different, why ??
            $ext =  $request->image->extension();
            $generatedImageName = 'image' . '-' . time() . '.' . $ext;

            //move to a folder
            $request->image->move(public_path('images'), $generatedImageName);

            //if the validation is pass, it will create object food new
            $foodAdd = Food::create([
                'name' => $request->input('name'),
                'count' => $request->input('count'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'image_path' => $generatedImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::channel('log_app')->info('CREATED', ['Food' => $foodAdd]);
            //save data to database
            $foodAdd->save();

            $response = array(
                "message" => "Create food success!",
                'type' => "success",
            );
            return Redirect('/foods')->with($response);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function edit($id)
    {
        try {
            $foodEdit = Food::find($id);
            $categories = $this->getCategories();

            return Inertia::render('Food/EditFood',['categories' => $categories, 'food' => $foodEdit]);
            //return view('foods.edit', ['categories' => $categories, 'food' => $foodEdit]);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function update(Request $request, $id)
    {
        try {
           
            return back()->with("message" ,"Modify food don't success!");
            $image_path = "";
            $food = Food::find($id);
            if(!$food)
                return back()->with("message" ,"Modify food don't success!");

            if ($request->hasFile('image')) {
                // validate data request if has file image
                $request->validate([
                    "name" => "required|unique:foods,name," . $food->id . "id|max:255",
                    "count" => "required|integer|min:0|max:1000",
                    "category_id" => "required",
                    //Validate image
                    'image' => 'required|mimes:jpg,png,jpeg|max:100'
                ]);

                //client image's name and server's image name
                //must be different, why ??
                $ext =  $request->image->extension();
                $generatedImageName = 'image' . '-' .date('Ymd').'-'. time() . '.' . $ext;

                //move to a folder
                $request->image->move(public_path('images'), $generatedImageName);
                $image_path = $generatedImageName;
            } else {
                // validate data request if has not file image
                $request->validate([
                    "name" => "required|unique:foods,name," . $food->id . "id|max:255",
                    "count" => "required|integer|min:0|max:1000",
                    "category_id" => "required",
                ]);

                $image_path  = $request->image_path;
            }

            Food::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'count' => $request->count,
                    'category_id' => $request->category_id,
                    'description' => $request->description,
                    'image_path' => $image_path,
                    'updated_at' => now(),
                ]);

            Log::channel('log_app')->info('UPDATED', ['Food' => [
                'id' => $id,
                'name' => $request->name,
                'count' => $request->count,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image_path' => $image_path,
                'updated_at' => now(),
            ]]);

            $response = array(
                "message" => "Modify food success!",
                'type' => "success",
            );

            return Redirect('/foods')->with($response);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            //dd($request,$id);
            $foodDelete = Food::find($id);
            if (is_null($foodDelete)) {
                $response  = array(
                    "message" => "Delete food don't success!",
                    'type' => "error",
                );

                return Redirect('/foods')->with($response);
            }

            $foodDelete->delete();
            Log::channel('log_app')->info('DELETED', ['Food' => $foodDelete]);
            $response = array(
                "message" => "Delete food success!",
                'type' => "success",
            );
            return Redirect('/foods')->with($response);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function show($id)
    {
        try {
            $food = Food::find($id);
            $food->category->name;
            return Inertia::render('Food/ShowFood', ['food' => $food]);
            // return view('foods.detail')->with('food', $food);
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }


    /**Function support */
    private function getCategories()
    {
        $categories = Category::all();
        return $categories;
    }
    /**End Function support */
}
