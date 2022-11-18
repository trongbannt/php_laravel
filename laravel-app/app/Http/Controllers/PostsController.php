<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use ReflectionFunctionAbstract;
use Illuminate\Pagination\Paginator;

class PostsController extends Controller
{
    public function index()
    {
        //Query builders
        // $posts = DB::select("SELECT * FROM posts WHERE id = :id;",
        // [
        //     'id' => 3
        // ]);
        // $posts = DB::table("posts")
        // ->get();

        $posts = Post::Paginate(1);
        Paginator::useBootstrapFive();
        //dd($posts); //dd = die dump
        // print_r($posts);
        return view('posts.index', ["posts" => $posts]);
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //case 1
        //$postAdd = new Post();
        // $postAdd->title = $request->input("title");
        // $postAdd->body = $request->input("body");

        //case 2
        $postAdd = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        //save data to database
        $postAdd->save();

        return Redirect("/posts");
    }

    public function edit($id)
    {
        $postEdit = Post::find($id);
        //dd($postEdit);
        return view("posts.edit")->with('postEdit', $postEdit);
    }

    public function update(Request $request, $id)
    {
        Post::where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'body' => $request->input('body'),

            ]);
        return Redirect('/posts');
    }

    public function destroy(Request $request)
    {
        $id= $request->id;
        //dd($id);
        $item = Post::find($id)->delete();
       
        return redirect('posts');
    }
    
    // public function createPost2()
    // {
    //     //return view('posts.index');

    //     //Query builders
    //     // $posts = DB::select("SELECT * FROM posts WHERE id = :id;",
    //     // [
    //     //     'id' => 3
    //     // ]);
    //     $post = new Post();
    //     $post->title="";
    //     $posts = DB::table("posts")
    //     // ->where('id', '=', 5)
    //     // ->delete();
    //     // ->update([
    //     //     'title' => 'haha title',
    //     //     'body' => 'This is haha body',
    //     // ]);

    //     ->insert([
    //         'title' => 'haha',
    //         'body' => 'A new post hahaha'
    //     ]);

    //     //->avg('id');//average
    //     //->sum('id');
    //     //->min('id');
    //     //->count();
    //     //->find(3);//find by id
    //     //->whereNotNull("body")
    //     //->oldest()                    
    //     //->latest()
    //     //->orderBy('id', 'asc')
    //     // ->whereBetween("id", [1, 3])                    
    //     // ->where("created_at",">", now()->subDay())
    //     // ->orWhere('id', '>', 0)
    //     //->select('body')
    //     //->first();
    //     //dd($posts); //dd = die dump
    //     print_r($posts);
    //     //return view('posts.index');
    // }
}
