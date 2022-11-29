<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function edit(Request $request)
    {
        return Inertia::render('Profile/Edit');

        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);;
    }

    public function update(ProfileUpdateRequest $request)
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }

    public function destroy(Request $request)
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password']
            ]);

            $user = $request->user();
            Auth::logout();
            $user->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } catch (Throwable $exception) {
            Log::channel('log_app')->error($exception->getMessage());
            throw $exception;
        }
    }
}
