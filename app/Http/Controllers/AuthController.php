<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function loginForm() {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'Admin') {
                return redirect()->route('index');
            } elseif (Auth::user()->role === 'Kasir') {
                return redirect()->route('pesanan.index');
            } else{
                return view('login');
            }
    
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors([
                'login' => 'Username atau password salah!'
            ]);

    }

    public function logout(Request $request)
    {
        
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/loginPage')->with('message', 'Anda berhasil logout');;
    }

}
