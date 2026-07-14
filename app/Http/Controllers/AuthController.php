<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Username dan password sementara
        if (
            $request->email == 'admin@bnn.go.id' &&
            $request->password == '12345'
        ) {

            session([
                'admin_login' => true
            ]);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah.');
    }

    // Logout
    public function logout()
    {
        session()->forget('admin_login');

        return redirect()->route('home');
    }
}