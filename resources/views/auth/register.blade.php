<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrasi Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>


<body class="login-admin-body">


    <section class="login-admin-page">


        <div class="login-admin-card">


            {{-- ICON --}}

            <div class="login-icon">

                <i class="bi bi-person-plus-fill"></i>

            </div>


            {{-- JUDUL --}}

            <h2>Registrasi Admin</h2>


            <p>

                Buat Akun Administrator

                <br>

                BNNK Tulungagung

            </p>


            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <i class="bi bi-check-circle-fill me-1"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- ERROR MESSAGE --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <i class="bi bi-exclamation-triangle-fill me-1"></i>

                    <strong>
                        Terjadi kesalahan:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORM REGISTRASI --}}

            <form action="{{ route('register.proses') }}" method="POST">

                @csrf


                {{-- NAMA --}}

                <div class="input-login">

                    <i class="bi bi-person-fill"></i>

                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap"
                        required autocomplete="name">

                </div>


                {{-- EMAIL --}}

                <div class="input-login">

                    <i class="bi bi-envelope-fill"></i>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required
                        autocomplete="email">

                </div>


                {{-- ROLE --}}

                <div class="input-login">

                    <i class="bi bi-person-badge-fill"></i>

                    <select name="role" required style="
                        width:100%;
                        border:none;
                        outline:none;
                        background:transparent;
                        padding-left:5px;
                    ">

                        <option value="">
                            Pilih Role Admin
                        </option>

                        <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>
                            Super Admin
                        </option>

                        <option value="adminpengaduan" {{ old('role') === 'adminpengaduan' ? 'selected' : '' }}>
                            Admin Pengaduan
                        </option>

                        <option value="adminpermohonan" {{ old('role') === 'adminpermohonan' ? 'selected' : '' }}>
                            Admin Permohonan
                        </option>

                    </select>

                </div>


                {{-- PASSWORD --}}

                <div class="input-login">

                    <i class="bi bi-lock-fill"></i>

                    <input type="password" name="password" placeholder="Masukkan Password" required
                        autocomplete="new-password">

                </div>


                {{-- KONFIRMASI PASSWORD --}}

                <div class="input-login">

                    <i class="bi bi-shield-lock-fill"></i>

                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                        autocomplete="new-password">

                </div>


                {{-- BUTTON --}}

                <button type="submit" class="btn-admin-login" style="border:none; width:100%;">

                    <i class="bi bi-person-plus-fill"></i>

                    Daftar Admin

                </button>


            </form>


            {{-- DIVIDER --}}

            <div class="divider">

                <span>atau</span>

            </div>


            {{-- KEMBALI KE LOGIN --}}

            <a href="{{ route('login') }}" class="btn-back">

                <i class="bi bi-box-arrow-in-left me-1"></i>

                Kembali ke Login

            </a>


            {{-- KEMBALI KE BERANDA --}}

            <a href="{{ route('home') }}" class="btn-back">

                ← Kembali ke Beranda

            </a>


        </div>


    </section>


</body>

</html>