<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        try{
            
           $validated =  $request->validateWithBag('updatePassword',[
                'current_password'=>['required','current_password'],
                'new_password'=>['required','min:8', 'confirmed']
            ]);

            $request->user()->update([
                'password'=>Hash::make($validated['new_password'])
            ]);

            return back()->with('status', 'password-updated');

        }catch(Throwable $exception){
            Log::channel("log-app")->error($exception->getMessage());
            throw $exception;
        }
    }   
    
}
