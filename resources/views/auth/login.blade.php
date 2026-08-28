<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="login-admin-body">

    <section class="login-admin-page">

        <div class="login-admin-card">

            <div class="login-icon">

                <i class="bi bi-shield-lock-fill"></i>

            </div>

            <h2>Login Admin</h2>

            <p>

                Portal Pengaduan dan Permohonan

                <br>

                BNNK Tulungagung

            </p>


            {{-- =====================================================
            PESAN SUCCESS
            ====================================================== --}}

            @if(session('success'))

                <div class="alert alert-success text-start">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- =====================================================
            PESAN ERROR
            ====================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger text-start">

                    <i class="bi bi-exclamation-circle-fill me-2"></i>

                    {{ session('error') }}

                </div>

            @endif


            {{-- =====================================================
            ERROR VALIDASI
            ====================================================== --}}

            @if($errors->any())

                <div class="alert alert-danger text-start">

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
            LOGIN EMAIL + PASSWORD
            ====================================================== --}}

            <form action="{{ route('login.proses') }}" method="POST">

                @csrf


                {{-- EMAIL --}}

                <div class="input-login">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email"
                        autocomplete="email" required>

                </div>


                {{-- PASSWORD --}}

                <div class="input-login">

                    <i class="bi bi-lock-fill"></i>

                    <input type="password" name="password" id="password" placeholder="Masukkan Password"
                        autocomplete="current-password" required>

                    <i class="bi bi-eye-fill"  id="togglePassword"
       style="cursor: pointer;"></i>

                </div>


                {{-- =================================================
                INGAT SAYA + LUPA PASSWORD
                ================================================== --}}

                <div class="login-menu">

                    <label>

                        <input type="checkbox" name="remember" value="1">

                        Ingat Saya

                    </label>


                    <!-- <a href="{{ route('forgot.password') }}">

                        Lupa Password?

                    </a> -->

                </div>


                {{-- =================================================
                BUTTON LOGIN
                ================================================== --}}

                <button type="submit" class="btn-admin-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Masuk

                </button>

            </form>


            {{-- =====================================================
            PEMBATAS LOGIN
            ====================================================== --}}

            <div class="divider">

                <span>atau</span>

            </div>


            {{-- =====================================================
            LOGIN GOOGLE SUPERADMIN
            ====================================================== --}}

            <a href="{{ route('google.redirect') }}" class="btn-google">

                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">

                Masuk dengan Google

            </a>


            <small class="d-block text-muted mt-3">

                Login Google digunakan untuk akun SuperAdmin.

            </small>


            {{-- =====================================================
            DAFTAR ADMIN
            ====================================================== --}}
            <!-- 
            <a href="{{ route('register') }}" class="btn-admin-register">

                <i class="bi bi-person-plus-fill"></i>

                Daftar Admin

            </a> -->


            {{-- =====================================================
            KEMBALI KE BERANDA
            ====================================================== --}}

            <a href="{{ route('home') }}" class="btn-back">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Beranda

            </a>

        </div>

    </section>

</body>

</html>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Ubah tipe input
        const type = password.getAttribute('type') === 'password'
            ? 'text'
            : 'password';

        password.setAttribute('type', type);

        // Ubah icon mata
        this.classList.toggle('bi-eye-fill');
        this.classList.toggle('bi-eye-slash-fill');
    });
</script>