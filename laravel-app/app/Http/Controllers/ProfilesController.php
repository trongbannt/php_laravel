<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function edit(Request $request){
        return view('profile.edit', [
            'user' => $request->user(),
        ]);;
    }
}
