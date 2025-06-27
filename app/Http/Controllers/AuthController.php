<?php

namespace App\Http\Controllers;

use App\Models\AuliaUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = AuliaUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return $user->role === 'admin' ? redirect('/admin') : redirect('/');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function logout()
    {   
        Auth::logout();
        return redirect('/login');
    }
}
