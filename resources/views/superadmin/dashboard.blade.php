<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Super Admin BNNK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">

</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->

        <aside class="sidebar">

            <div class="logo">

                <img src="{{ asset('images/logo-bnn.png') }}">

                <h4>SUPER ADMIN</h4>

            </div>

            <ul>

                <li class="active">

                    <i class="bi bi-grid-fill"></i>

                    Dashboard

                </li>

                <li>

                    <i class="bi bi-people-fill"></i>

                    Data Admin

                </li>

                <li>

                    <i class="bi bi-file-earmark-text-fill"></i>

                    Pengaduan

                </li>

                <li>

                    <i class="bi bi-envelope-paper-fill"></i>

                    Permohonan

                </li>

                <li>

                    <i class="bi bi-clock-history"></i>

                    Aktivitas

                </li>

                <li>

                    <i class="bi bi-gear-fill"></i>

                    Pengaturan

                </li>

            </ul>

            <a href="#" class="logout">

                <i class="bi bi-box-arrow-left"></i>

                Logout

            </a>

        </aside>

        <!-- Content -->

        <main class="content">

            <div class="header">

                <h2>Dashboard Super Admin</h2>

                <button class="profile">

                    Super Admin

                </button>

            </div>

            <!-- Card -->

            <div class="cards">

                <div class="card-box">

                    <h5>Total Admin</h5>

                    <h2>15</h2>

                </div>

                <div class="card-box">

                    <h5>Pengaduan</h5>

                    <h2>530</h2>

                </div>

                <div class="card-box">

                    <h5>Permohonan</h5>

                    <h2>200</h2>

                </div>

                <div class="card-box">

                    <h5>Akun Google</h5>

                    <h2>18</h2>

                </div>

            </div>

            <!-- Tabel -->

            <div class="table-box">

                <h4>Data Admin Terdaftar</h4>

                <table class="table">

                    <thead>

                        <tr>

                            <th>Nama</th>

                            <th>Email</th>

                            <th>Login</th>

                            <th>Tanggal</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>Andi</td>

                            <td>andi@gmail.com</td>

                            <td>Google</td>

                            <td>15 Juli 2026</td>

                            <td>

                                <button class="btn btn-primary btn-sm">

                                    Detail

                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</body>

</html>