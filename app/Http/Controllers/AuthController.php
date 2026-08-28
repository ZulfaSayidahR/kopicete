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
     *
     * SuperAdmin TIDAK boleh login melalui form ini.
     * SuperAdmin wajib menggunakan Google.
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
        | CARI USER
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            $credentials['email']
        )->first();


        /*
        |--------------------------------------------------------------------------
        | USER TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            return back()
                ->withInput(
                    $request->only('email')
                )
                ->with(
                    'error',
                    'Email atau password salah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SUPERADMIN TIDAK BOLEH LOGIN DENGAN EMAIL + PASSWORD
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'superadmin') {

            return back()
                ->withInput(
                    $request->only('email')
                )
                ->with(
                    'error',
                    'SuperAdmin harus login menggunakan akun Google.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK ROLE ADMIN
        |--------------------------------------------------------------------------
        |
        | Form login ini hanya diperbolehkan untuk:
        |
        | admin_pengaduan
        | admin_permohonan
        |
        */

        if (
            !in_array($user->role, [
                'admin_pengaduan',
                'admin_permohonan',
            ])
        ) {

            return back()
                ->withInput(
                    $request->only('email')
                )
                ->with(
                    'error',
                    'Role akun tidak valid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK STATUS AKUN
        |--------------------------------------------------------------------------
        */

        if (!$user->is_active) {

            return back()
                ->withInput(
                    $request->only('email')
                )
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
                ->withInput(
                    $request->only('email')
                )
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
        $remember = $request->boolean('remember');

        Auth::login($user, $remember);

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
        | JIKA ROLE TIDAK VALID
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

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
     *
     * ATURAN:
     *
     * 1. Jika Google ID sudah terdaftar sebagai SuperAdmin
     *    → izinkan login.
     *
     * 2. Jika belum terdaftar DAN belum ada SuperAdmin
     *    → Google tersebut menjadi SuperAdmin pertama.
     *
     * 3. Jika belum terdaftar DAN SuperAdmin sudah ada
     *    → TOLAK LOGIN.
     *
     * Dengan demikian hanya ada 1 akun SuperAdmin.
     */
    public function handleGoogleCallback()
    {
        try {

            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA GOOGLE
            |--------------------------------------------------------------------------
            */

            $googleUser = Socialite::driver('google')
                ->user();


            /*
            |--------------------------------------------------------------------------
            | DATA GOOGLE
            |--------------------------------------------------------------------------
            */

            $googleId = $googleUser->getId();
            $googleEmail = $googleUser->getEmail();
            $googleName = $googleUser->getName()
                ?? 'Super Admin';


            /*
            |--------------------------------------------------------------------------
            | CARI USER BERDASARKAN GOOGLE ID
            |--------------------------------------------------------------------------
            |
            | Hanya mencari user SuperAdmin.
            |
            */

            $user = User::where(
                'google_id',
                $googleId
            )
                ->where(
                    'role',
                    'superadmin'
                )
                ->first();


            /*
            |--------------------------------------------------------------------------
            | GOOGLE INI ADALAH SUPERADMIN YANG SUDAH TERDAFTAR
            |--------------------------------------------------------------------------
            */

            if ($user) {

                /*
                |--------------------------------------------------------------------------
                | CEK STATUS AKUN
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
            }


            /*
            |--------------------------------------------------------------------------
            | GOOGLE BELUM TERDAFTAR SEBAGAI SUPERADMIN
            |--------------------------------------------------------------------------
            |
            | Sekarang kita cek apakah sudah ada SuperAdmin.
            |
            */

            $existingSuperAdmin = User::where(
                'role',
                'superadmin'
            )->first();


            /*
            |--------------------------------------------------------------------------
            | BELUM ADA SUPERADMIN
            |--------------------------------------------------------------------------
            |
            | Google pertama otomatis menjadi SuperAdmin.
            |
            */

            if (!$existingSuperAdmin) {

                /*
                |--------------------------------------------------------------------------
                | CEK EMAIL GOOGLE
                |--------------------------------------------------------------------------
                |
                | Pastikan email Google belum digunakan akun lain.
                |
                */

                $existingEmail = User::where(
                    'email',
                    $googleEmail
                )->first();


                if ($existingEmail) {

                    return redirect()
                        ->route('login')
                        ->with(
                            'error',
                            'Email Google tersebut sudah digunakan oleh akun lain.'
                        );
                }


                /*
                |--------------------------------------------------------------------------
                | BUAT SUPERADMIN PERTAMA
                |--------------------------------------------------------------------------
                */

                $user = User::create([

                    'name' => $googleName,

                    'email' => $googleEmail,

                    'password' => Hash::make(
                        Str::random(40)
                    ),

                    'google_id' => $googleId,

                    'role' => 'superadmin',

                    'is_active' => true,

                ]);


                /*
                |--------------------------------------------------------------------------
                | LOGIN SUPERADMIN BARU
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
                        'Akun SuperAdmin berhasil dibuat melalui Google.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | SUPERADMIN SUDAH ADA
            |--------------------------------------------------------------------------
            |
            | PENTING:
            |
            | Google yang berbeda TIDAK BOLEH menjadi SuperAdmin.
            |
            */

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Akun SuperAdmin sudah terdaftar. Hanya akun Google SuperAdmin yang terdaftar yang dapat login.'
                );


        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | GOOGLE LOGIN ERROR
            |--------------------------------------------------------------------------
            */

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
        return view(
            'auth.forgot_password'
        );
    }


    /**
     * Mengirim link reset password.
     *
     * Hanya SuperAdmin yang boleh menggunakan fitur ini.
     */
    public function sendResetLink(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ], [
            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CARI SUPERADMIN
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            $request->email
        )
            ->where(
                'role',
                'superadmin'
            )
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
        | CEK STATUS
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
        | KIRIM RESET LINK
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

    public function resetPassword(
        Request $request
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

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

                /*
                |--------------------------------------------------------------------------
                | PASTIKAN YANG DIRESET HANYA SUPERADMIN
                |--------------------------------------------------------------------------
                */

                if ($user->role !== 'superadmin') {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE PASSWORD
                |--------------------------------------------------------------------------
                */

                $user->forceFill([

                    'password' =>
                        Hash::make($password),

                    'remember_token' =>
                        Str::random(60),

                ])->save();


                /*
                |--------------------------------------------------------------------------
                | EVENT PASSWORD RESET
                |--------------------------------------------------------------------------
                */

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

    public function logout(
        Request $request
    ) {

        Auth::logout();

        $request
            ->session()
            ->invalidate();

        $request
            ->session()
            ->regenerateToken();


        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}