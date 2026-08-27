<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="login-admin-body">

    <section class="login-admin-page">

        <div class="login-admin-card">

            {{-- ICON --}}
            <div class="login-icon">

                <i class="bi bi-shield-lock-fill"></i>

            </div>


            {{-- JUDUL --}}
            <h2>Reset Password</h2>


            {{-- KETERANGAN --}}
            <p>

                Silakan masukkan password baru untuk akun Anda.

            </p>


            {{-- ERROR VALIDASI --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ERROR DARI SESSION --}}
            @if(session('error'))

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    {{ session('error') }}

                </div>

            @endif


            {{-- FORM RESET PASSWORD --}}
            <form method="POST" action="{{ route('password.update') }}">

                @csrf


                {{-- TOKEN DARI EMAIL --}}
                <input type="hidden" name="token" value="{{ $token }}">


                {{-- EMAIL --}}
                <div class="input-login mb-3">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Email"
                        autocomplete="email" required>

                </div>


                {{-- PASSWORD BARU --}}
                <div class="input-login mb-3">

                    <i class="bi bi-lock-fill"></i>

                    <input type="password" name="password" placeholder="Password Baru" autocomplete="new-password"
                        required>

                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div class="input-login mb-3">

                    <i class="bi bi-lock-fill"></i>

                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru"
                        autocomplete="new-password" required>

                </div>


                {{-- BUTTON --}}
                <button type="submit" class="btn-admin-login">

                    <i class="bi bi-check-circle-fill"></i>

                    Simpan Password Baru

                </button>

            </form>


            {{-- PEMBATAS --}}
            <div class="divider">

                <span>atau</span>

            </div>


            {{-- KEMBALI LOGIN --}}
            <a href="{{ route('login') }}" class="btn-back">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Login

            </a>

        </div>

    </section>

</body>

</html>