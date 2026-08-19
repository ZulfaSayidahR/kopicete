<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




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
    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],

            'role' => [
                'required',
                'in:superadmin,adminpengaduan,adminpermohonan'
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed'
            ],
        ], [

            'name.required' =>
                'Nama wajib diisi.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email tersebut sudah terdaftar.',

            'role.required' =>
                'Silakan pilih role admin.',

            'role.in' =>
                'Role admin tidak valid.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',
        ]);


        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make(
                $request->password
            ),

            'role' => $request->role,

        ]);


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Akun admin berhasil dibuat. Silakan login.'
            );
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