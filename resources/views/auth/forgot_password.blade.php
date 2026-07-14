<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="login-admin-body">

    <section class="login-admin-page">

        <div class="login-admin-card">

            <div class="login-icon">

                <i class="bi bi-key-fill"></i>

            </div>

            <img src="{{ asset('images/logo-bnn.png') }}" class="admin-logo">

            <h2>Lupa Password</h2>

            <p>

                Masukkan email Admin yang terdaftar.

                <br>

                Kami akan mengirimkan tautan untuk mengatur ulang password.

            </p>

            @if(session('status'))

                <div class="alert alert-success">

                    {{ session('status') }}

                </div>

            @endif

            <form method="POST" action="{{ route('password.email') }}">

                @csrf

                <div class="input-login">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" placeholder="Masukkan Email Admin" required>

                </div>

                <button type="submit" class="btn-admin-login">

                    <i class="bi bi-send-fill"></i>

                    Kirim Link Reset Password

                </button>

            </form>

            <div class="divider">

                <span>atau</span>

            </div>

            <a href="{{ route('login') }}" class="btn-back">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Login

            </a>

        </div>

    </section>

</body>

</html>