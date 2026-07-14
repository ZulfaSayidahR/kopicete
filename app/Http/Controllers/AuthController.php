<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Sementara hanya redirect
    public function login(Request $request)
    {
        return redirect()->route('home');
    }
}