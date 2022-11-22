<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt. when submit form login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            //dd($request);
            $remember = false;
            if($request->has('remember')){
                $remember = true;
            }
            
           // dd($request);
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

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        } catch (Throwable $exception) {

            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }
}
