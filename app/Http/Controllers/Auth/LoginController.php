<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

      
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Invalid credentials. Please try again.');
    }


}
