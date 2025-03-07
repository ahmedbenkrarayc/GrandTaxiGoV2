<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request)
    {
        $role = $request->input('role', 'passenger');

        Session::put('role', $role);

        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $google_user->getEmail()],
                [
                    'fname' => $google_user->user['given_name'] ?? '',
                    'lname' => $google_user->user['family_name'] ?? '',
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'photo' => $google_user->getAvatar()
                ]
            );

            if ($user->wasRecentlyCreated) {
                $role = Session::get('role', 'passenger');
                $user->addRole($role);
            }

            Auth::login($user);
            return redirect(route('dashboard', absolute: false));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Log::error('Google Auth Error: ' . $th->getMessage());
            return redirect('/login')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
