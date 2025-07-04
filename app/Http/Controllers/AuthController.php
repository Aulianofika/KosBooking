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
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:aulia_users,email',
        'password' => 'required|string|confirmed|min:6',
    ]);

    AuliaUser::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => 'user', // default
        'password' => Hash::make($request->password),
    ]);

    // Setelah registrasi berhasil, arahkan pengguna ke halaman login

    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login terlebih dahulu.');
}

}
