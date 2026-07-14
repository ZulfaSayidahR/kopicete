<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman Login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Proses Login
     */
    public function loginProses(Request $request)
    {
        // Sementara hanya redirect ke halaman home
        return redirect()->route('home');
    }

    /**
     * Menampilkan halaman Forgot Password
     */
    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    /**
     * Proses Forgot Password
     */
    public function forgotPasswordProses(Request $request)
    {
        return back()->with(
            'success',
            'Link reset password berhasil dikirim ke email Anda.'
        );
    }
}