<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin | BNNK Tulungagung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="login-admin-body">

    <section class="login-admin-page">

        <div class="login-admin-card">

            <div class="login-icon">

                <i class="bi bi-shield-lock-fill"></i>

            </div>

            <img src="{{ asset('images/logo-bnn.png') }}" class="admin-logo">

            <h2>Login Admin</h2>

            <p>

                Portal Pengaduan dan Permohonan

                <br>

                BNNK Tulungagung

            </p>

            <form action="{{ route('login.proses') }}" method="POST">

                @csrf

                <div class="input-login">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" placeholder="Masukkan Email" required>

                </div>

                <div class="input-login">

                    <i class="bi bi-lock-fill"></i>

                    <input type="password" name="password" placeholder="Masukkan Password" required>

                </div>

                <div class="login-menu">

                    <label>

                        <input type="checkbox">

                        Ingat Saya

                    </label>

                    <a href="#">

                        Lupa Password?

                    </a>

                </div>

                <button type="submit" class="btn-admin-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Masuk

                </button>

            </form>

            <div class="divider">

                <span>atau</span>

            </div>

            <a href="{{ route('google.login') }}" class="btn-google">

                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg">

                Masuk dengan Google

            </a>

            <a href="{{ route('home') }}" class="btn-back">

                ← Kembali ke Beranda

            </a>

        </div>

    </section>

</body>

</html>