<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Food;
use App\Models\Category;



class FoodsController extends Controller
{
    public function index()
    {

        $foods = Food::all();
        return view('foods.index', ['foods' => $foods]);
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('foods.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // $extension = $request->file('image')->guessExtension();
        // $size = $request->file('image')->getSize();
        // $error = $request->file('image')->getError();
        // $vali = $request->file('image')->isValid();

        //dd($extension, $size, $error, $vali,$generatedImageName,$request->file('image'));

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
        $generatedImageName = 'image' . '-' . time() .'.'. $ext;

        //move to a folder
        $request->image->move(public_path('images'), $generatedImageName);

        //if the validation is pass, it will create object food new
        $foodAdd = Food::create([
            'name' => $request->input('name'),
            'count' => $request->input('count'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'image_path' => $generatedImageName??'',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //save data to database
        $foodAdd->save();

        $response = array(
            "message" => "Create food success!",
            'type' => "success",
        );
        return Redirect('/foods')->with($response);
    }

    public function edit($id)
    {
        $foodEdit = Food::find($id);
        $categories = $this->getCategories();
        return view('foods.edit', ['categories' => $categories, 'food' => $foodEdit]);
    }

    public function update(Request $request, $id)
    {

        // dd($request, $id);
        // validate data request
        //  $request->validate([
        //     "name"=>"required|name|unique:foods,name|max:255".$id,
        //     "count"=>"required|integer|min:0|max:1000",
        //     "category_id"=>"required"
        // ]);


        //dd('update ');
        if (!isset($id)) {
            $response = array(
                "message" => "Modify food don't success!",
                'type' => "error",
            );

            return Redirect('/foods')->with($response);
        }

        Food::where('id', $id)
            ->update([
                'name' => $request->input('name') ?? '',
                'count' => $request->input('count') ?? 0,
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description') ?? '',
                'updated_at' => now(),
            ]);

        $response = array(
            "message" => "Modify food success!",
            'type' => "success",
        );

        return Redirect('/foods')->with($response);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if (isset($id)) {
            $foodDelete = Food::find($id);
            if (!is_null($foodDelete)) {
                $foodDelete->delete();
            } else {
                $response  = array(
                    "message" => "Delete food don't success!",
                    'type' => "error",
                );

                return Redirect('/foods')->with($response);
            }
        } else {
            $response = array(
                "message" => "Delete food don't success!",
                'type' => "error",
            );

            return Redirect('/foods')->with($response);
        }

        $response = array(
            "message" => "Delete food success!",
            'type' => "success",
        );
        return Redirect('/foods')->with($response);
    }

    public function show($id)
    {
        $food = Food::find($id);
        return view('foods.detail')->with('food', $food);
    }


    /**Function support */
    private function getCategories()
    {
        $categories = Category::all();
        return $categories;
    }
    /**End Function support */
}
