<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
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
        return response()->json(['data_1' => $data_1,'data_2' => $data_2,'data3' => $data_3]);
    }

    public function login(Request $request)
    {
        try {
            return response()->json(['res' => $request]);

            $remember = false;
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();

                return redirect()->intended('/');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }
}
