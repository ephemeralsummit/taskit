<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Wrong Password!',
    ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

        public function register(Request $request)
    {
        $request->validate([
                'name' => ['required', 'min:5', 'max:100'],
                'email' => ['required', 'unique:users,email', 'max:100'],
                'password' => ['required', 'min:3'],
            ]);

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;

            User::create ([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect ('/')->with ('success','User registered!');
    }
}