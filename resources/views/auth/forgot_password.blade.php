<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Password SuperAdmin</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="login-admin-body">

    <section class="login-admin-page">

        <div class="login-admin-card">

            {{-- =====================================================
            ICON
            ====================================================== --}}
            <div class="login-icon">

                <i class="bi bi-key-fill"></i>

            </div>


            {{-- =====================================================
            JUDUL
            ====================================================== --}}
            <h2>Lupa Password</h2>


            {{-- =====================================================
            KETERANGAN
            ====================================================== --}}
            <p>

                Masukkan email <strong>SuperAdmin</strong> yang
                terdaftar pada sistem.

                <br>

                Kami akan mengirimkan tautan untuk mengatur ulang
                password Anda.

            </p>


            {{-- =====================================================
            PESAN BERHASIL
            ====================================================== --}}
            @if(session('success'))

                <div class="alert alert-success">

                    <i class="bi bi-check-circle-fill me-1"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- =====================================================
            PESAN ERROR
            ====================================================== --}}
            @if(session('error'))

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-triangle-fill me-1"></i>

                    {{ session('error') }}

                </div>

            @endif


            {{-- =====================================================
            ERROR VALIDASI
            ====================================================== --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
            FORM FORGOT PASSWORD
            ====================================================== --}}
            <form method="POST" action="{{ route('forgot.password.send') }}">

                @csrf


                {{-- =================================================
                EMAIL SUPERADMIN
                ================================================== --}}
                <div class="input-login">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email SuperAdmin"
                        autocomplete="email" required>

                </div>


                {{-- =================================================
                BUTTON
                ================================================== --}}
                <button type="submit" class="btn-admin-login">

                    <i class="bi bi-send-fill"></i>

                    Kirim Link Reset Password

                </button>

            </form>


            {{-- =====================================================
            PEMBATAS
            ====================================================== --}}
            <div class="divider">

                <span>atau</span>

            </div>


            {{-- =====================================================
            KEMBALI KE LOGIN
            ====================================================== --}}
            <a href="{{ route('login') }}" class="btn-back">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Login

            </a>

        </div>

    </section>


    {{-- =========================================================
    BOOTSTRAP JS
    ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>