@extends('layouts.admin')

@section('title', 'Dashboard Super Admin')

@section('content')

    <section class="sa-dashboard" id="adminPengaduanDashboard" {{-- Sidebar dipanggil dari satu file --}}
        @include('layouts.sidebar_admin') {{--=================================================KONTEN
        UTAMA==================================================--}} <main class="sa-main">

        {{-- HEADER --}}
        <header class="sa-topbar">

            <div class="sa-topbar-left">

                <button type="button" class="sa-toggle-sidebar" id="toggleSidebar" aria-label="Buka atau tutup sidebar"
                    aria-controls="superAdminSidebar" aria-expanded="true">

                    <i class="bi bi-list"></i>

                </button>

                <div class="sa-page-heading">

                    <h1>Dashboard Admin Pengaduan</h1>

                    <p>
                        Monitoring Portal Pengaduan dan Permohonan
                        BNNK Tulungagung
                    </p>

                </div>

            </div>

            <div class="sa-profile">

                <div class="sa-profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="sa-profile-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Admin Pengaduan'}}
                    </strong>

                    <small>Administrator Pengaduan</small>

                </div>

                <i class="bi bi-chevron-down sa-profile-arrow"></i>

            </div>

        </header>

        {{-- =================================================
        STATISTIK
        ================================================== --}}
        <section class="sa-statistics">

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="sa-stat-content">

                    <span>Total Admin</span>

                    <h2>15</h2>

                    <small>
                        <i class="bi bi-arrow-up-short"></i>
                        2 akun baru
                    </small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-green">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>

                <div class="sa-stat-content">

                    <span>Total Pengaduan</span>

                    <h2>530</h2>

                    <small>
                        <i class="bi bi-clock"></i>
                        18 sedang diproses
                    </small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-yellow">
                    <i class="bi bi-envelope-paper-fill"></i>
                </div>

                <div class="sa-stat-content">

                    <span>Total Permohonan</span>

                    <h2>200</h2>

                    <small>
                        <i class="bi bi-envelope-check"></i>
                        Permohonan masuk
                    </small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div class="sa-stat-content">

                    <span>Laporan Selesai</span>

                    <h2>176</h2>

                    <small>
                        <i class="bi bi-check2-all"></i>
                        Telah ditindaklanjuti
                    </small>

                </div>

            </article>

        </section>

        {{-- =================================================
        DATA ADMIN
        ================================================== --}}
        <section class="sa-panel sa-admin-panel">

            <div class="sa-panel-header">

                <div>

                    <h3>Data Admin Terdaftar</h3>

                    <p>
                        Daftar akun admin yang pernah masuk ke sistem.
                    </p>

                </div>

                <div class="sa-table-tools">

                    <div class="sa-search-box">

                        <i class="bi bi-search"></i>

                        <input type="search" id="adminSearch" placeholder="Cari nama atau email..." autocomplete="off">

                    </div>

                    <a href="{{ route('adminpengaduan.data_pengaduan') }}" class="sa-filter-button">

                        <i class="bi bi-people-fill"></i>

                        <span>Lihat Semua</span>

                    </a>

                </div>

            </div>

            <div class="sa-table-responsive">

                <table class="sa-table" id="adminTable">

                    <thead>

                        <tr>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Metode Login</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Status</th>
                            <th class="sa-action-column">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>

                                <div class="sa-admin-user">

                                    <div class="sa-admin-avatar">
                                        A
                                    </div>

                                    <div>
                                        <strong>Andi Saputra</strong>
                                        <small>Admin Pengaduan</small>
                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="sa-email-text">
                                    andi@gmail.com
                                </span>

                            </td>

                            <td>

                                <span class="sa-login-badge">

                                    <i class="bi bi-google"></i>

                                    Google

                                </span>

                            </td>

                            <td>15 Juli 2026</td>

                            <td>

                                <span class="sa-status-badge active">

                                    <span></span>

                                    Aktif

                                </span>

                            </td>

                            <td>

                                <div class="sa-action-buttons">

                                    <button type="button" class="sa-action-button sa-detail-button"
                                        title="Lihat detail admin" aria-label="Lihat detail Andi Saputra">

                                        <i class="bi bi-eye-fill"></i>

                                    </button>

                                    <button type="button" class="sa-action-button sa-key-button"
                                        title="Reset password admin" aria-label="Reset password Andi Saputra">

                                        <i class="bi bi-key-fill"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>

                                <div class="sa-admin-user">

                                    <div class="sa-admin-avatar purple">
                                        S
                                    </div>

                                    <div>
                                        <strong>Siti Rahma</strong>
                                        <small>Admin Permohonan</small>
                                    </div>

                                </div>

                            </td>

                            <td>

                                <span class="sa-email-text">
                                    siti@gmail.com
                                </span>

                            </td>

                            <td>

                                <span class="sa-login-badge">

                                    <i class="bi bi-google"></i>

                                    Google

                                </span>

                            </td>

                            <td>10 Juli 2026</td>

                            <td>

                                <span class="sa-status-badge active">

                                    <span></span>

                                    Aktif

                                </span>

                            </td>

                            <td>

                                <div class="sa-action-buttons">

                                    <button type="button" class="sa-action-button sa-detail-button"
                                        title="Lihat detail admin" aria-label="Lihat detail Siti Rahma">

                                        <i class="bi bi-eye-fill"></i>

                                    </button>

                                    <button type="button" class="sa-action-button sa-key-button"
                                        title="Reset password admin" aria-label="Reset password Siti Rahma">

                                        <i class="bi bi-key-fill"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="sa-table-footer">

                <span>Menampilkan 2 dari 15 admin</span>

                <div class="sa-pagination">

                    <button type="button" disabled aria-label="Halaman sebelumnya">

                        <i class="bi bi-chevron-left"></i>

                    </button>

                    <button type="button" class="active" aria-label="Halaman 1">

                        1

                    </button>

                    <button type="button" aria-label="Halaman 2">

                        2

                    </button>

                    <button type="button" aria-label="Halaman selanjutnya">

                        <i class="bi bi-chevron-right"></i>

                    </button>

                </div>

            </div>

        </section>

        </main>

    </section>

@endsection

@push('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('adminSearch');
            const adminTable = document.getElementById('adminTable');

            if (!searchInput || !adminTable) {
                return;
            }

            searchInput.addEventListener('input', function () {
                const keyword = this.value
                    .trim()
                    .toLowerCase();

                const rows = adminTable.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    const rowContent = row.textContent
                        .trim()
                        .toLowerCase();

                    row.style.display = rowContent.includes(keyword)
                        ? ''
                        : 'none';
                });
            });
        });
    </script>

@endpush