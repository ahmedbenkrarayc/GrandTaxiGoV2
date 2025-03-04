<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
            'phone' => ['required', 'string'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        
        $file = $request->file('photo');
        $fileName = 'photo_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('assets/images', $fileName, 'public');

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $filePath,
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        // Auth::login($user);
        $user->addRole($request->role);

        return redirect(route('dashboard', absolute: false));
    }
}
