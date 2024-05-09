<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('books');
            } else {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login')->with('alert', 'Hibás email vagy jelszó.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
