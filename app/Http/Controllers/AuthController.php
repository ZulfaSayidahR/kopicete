<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan halaman login.
     */
    public function login()
    {
        return view('auth.login');
    }


    /**
     * Proses login Admin Pengaduan dan Admin Permohonan.
     */
    /**
     * Proses login Admin Pengaduan dan Admin Permohonan.
     */
    /**
     * Proses login Admin Pengaduan dan Admin Permohonan.
     */
    public function loginProses(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI USER BERDASARKAN EMAIL
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $credentials['email'])->first();


        /*
        |--------------------------------------------------------------------------
        | USER TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Email atau password salah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ROLE
        |--------------------------------------------------------------------------
        |
        | Login form hanya untuk:
        |
        | - admin_pengaduan
        | - admin_permohonan
        |
        | SuperAdmin login menggunakan Google.
        |
        */

        if (
            !in_array($user->role, [
                'admin_pengaduan',
                'admin_permohonan',
            ])
        ) {

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'SuperAdmin harus login menggunakan Google.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS AKUN
        |--------------------------------------------------------------------------
        */

        if (!$user->is_active) {

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Akun Anda sedang dinonaktifkan oleh SuperAdmin.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD
        |--------------------------------------------------------------------------
        */

        if (
            !Hash::check(
                $credentials['password'],
                $user->password
            )
        ) {

            return back()
                ->withInput($request->only('email'))
                ->with(
                    'error',
                    'Email atau password salah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT ADMIN PENGADUAN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin_pengaduan') {

            return redirect()
                ->route('adminpengaduan.dashboard')
                ->with(
                    'success',
                    'Selamat datang, Admin Pengaduan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT ADMIN PERMOHONAN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin_permohonan') {

            return redirect()
                ->route('adminpermohonan.dashboard')
                ->with(
                    'success',
                    'Selamat datang, Admin Permohonan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK VALID
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        return redirect()
            ->route('login')
            ->with(
                'error',
                'Role akun tidak valid.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

    /**
     * Redirect ke halaman login Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirect();
    }


    /**
     * Callback setelah login Google.
     */
    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')
                ->user();


            /*
            |--------------------------------------------------------------------------
            | CARI SUPERADMIN BERDASARKAN GOOGLE ID
            |--------------------------------------------------------------------------
            */

            $user = User::where('google_id', $googleUser->getId())
                ->where('role', 'superadmin')
                ->first();


            /*
            |--------------------------------------------------------------------------
            | JIKA SUPERADMIN BELUM ADA
            |--------------------------------------------------------------------------
            |
            | Google account pertama akan menjadi SuperAdmin.
            |
            */

            if (!$user) {

                $superAdmin = User::where(
                    'role',
                    'superadmin'
                )->first();


                /*
                |--------------------------------------------------------------------------
                | BELUM ADA SUPERADMIN SAMA SEKALI
                |--------------------------------------------------------------------------
                */

                if (!$superAdmin) {

                    $user = User::create([

                        'name' => $googleUser->getName()
                            ?? 'Super Admin',

                        'email' => $googleUser->getEmail(),

                        'password' => Hash::make(
                            Str::random(40)
                        ),

                        'google_id' => $googleUser->getId(),

                        'role' => 'superadmin',

                        'is_active' => true,

                    ]);


                    Auth::login($user);

                    request()
                        ->session()
                        ->regenerate();


                    return redirect()
                        ->route('superadmin.dashboard')
                        ->with(
                            'success',
                            'Akun SuperAdmin berhasil dibuat melalui Google.'
                        );
                }


                /*
                |--------------------------------------------------------------------------
                | SUPERADMIN SUDAH ADA
                |--------------------------------------------------------------------------
                */

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Akun Google ini bukan akun SuperAdmin yang terdaftar.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | CEK AKTIF
            |--------------------------------------------------------------------------
            */

            if (!$user->is_active) {

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Akun SuperAdmin sedang dinonaktifkan.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | LOGIN SUPERADMIN
            |--------------------------------------------------------------------------
            */

            Auth::login($user);

            request()
                ->session()
                ->regenerate();


            return redirect()
                ->route('superadmin.dashboard')
                ->with(
                    'success',
                    'Selamat datang, SuperAdmin.'
                );


        } catch (\Exception $e) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Login Google gagal. Silakan coba kembali.'
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FORGOT PASSWORD
    |--------------------------------------------------------------------------
    */

    /**
     * Halaman Forgot Password.
     */
    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }


    /**
     * Mengirim link reset password.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI SUPERADMIN
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $request->email)
            ->where('role', 'superadmin')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | EMAIL BUKAN SUPERADMIN
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Email tersebut bukan email SuperAdmin yang terdaftar.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS SUPERADMIN
        |--------------------------------------------------------------------------
        */

        if (!$user->is_active) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Akun SuperAdmin sedang dinonaktifkan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | KIRIM LINK RESET PASSWORD
        |--------------------------------------------------------------------------
        */

        $status = Password::sendResetLink([
            'email' => $user->email,
        ]);


        /*
        |--------------------------------------------------------------------------
        | BERHASIL
        |--------------------------------------------------------------------------
        */

        if ($status === Password::RESET_LINK_SENT) {

            return back()
                ->with(
                    'success',
                    'Link reset password telah dikirim ke email SuperAdmin. Silakan periksa inbox email Anda.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GAGAL
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput()
            ->with(
                'error',
                'Gagal mengirim link reset password. Silakan coba kembali.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | FORM RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan form reset password.
     */
    public function showResetPassword(
        Request $request,
        $token
    ) {
        return view(
            'auth.reset_password',
            [
                'token' => $token,
                'email' => $request->email,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword(Request $request)
    {
        $request->validate([

            'token' => [
                'required',
            ],

            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

        ], [

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | RESET PASSWORD
        |--------------------------------------------------------------------------
        */

        $status = Password::reset(

            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function (User $user, string $password) {

                $user->forceFill([

                    'password' => Hash::make($password),

                    'remember_token' => Str::random(60),

                ])->save();


                event(
                    new PasswordReset($user)
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | BERHASIL
        |--------------------------------------------------------------------------
        */

        if ($status === Password::PASSWORD_RESET) {

            return redirect()
                ->route('login')
                ->with(
                    'success',
                    'Password berhasil direset. Silakan login kembali.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GAGAL
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('email')
            )
            ->with(
                'error',
                'Link reset password tidak valid atau sudah kedaluwarsa.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}