@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        {{-- =================================================
        SIDEBAR
        ================================================== --}}
        <aside class="sa-sidebar" id="superAdminSidebar">

            <div class="sa-sidebar-header">

                <div class="sa-brand-logo">
                    <img src="{{ asset('images/logo-bnn.png') }}" alt="Logo BNNK Tulungagung">
                </div>

                <div class="sa-brand-text">
                    <h4>SUPER ADMIN</h4>
                    <small>BNNK Tulungagung</small>
                </div>

            </div>

            <nav class="sa-navigation">

                <ul class="sa-menu">

                    <li class="sa-menu-item active">
                        <a href="{{ url('/superadmin/dashboard') }}">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sa-menu-item">
                        <a href="#">
                            <i class="bi bi-people-fill"></i>
                            <span>Data Admin</span>
                        </a>
                    </li>

                    <li class="sa-menu-item">
                        <a href="#">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>Pengaduan</span>
                        </a>
                    </li>

                    <li class="sa-menu-item">
                        <a href="#">
                            <i class="bi bi-envelope-paper-fill"></i>
                            <span>Permohonan</span>
                        </a>
                    </li>

                    <li class="sa-menu-item">
                        <a href="#">
                            <i class="bi bi-clock-history"></i>
                            <span>Aktivitas</span>
                        </a>
                    </li>

                </ul>

            </nav>

            <div class="sa-sidebar-footer">

                <a href="#" class="sa-logout">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </a>

            </div>

        </aside>

        {{-- Overlay untuk mobile --}}
        <button type="button" class="sa-sidebar-overlay" id="sidebarOverlay" aria-label="Tutup sidebar">
        </button>

        {{-- =================================================
        KONTEN UTAMA
        ================================================== --}}
        <main class="sa-main">

            {{-- HEADER --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button type="button" class="sa-toggle-sidebar" id="toggleSidebar" aria-label="Buka atau tutup sidebar">

                        <i class="bi bi-list"></i>

                    </button>

                    <div class="sa-page-heading">
                        <h1>Dashboard Super Admin</h1>
                        <p>Monitoring Portal Pengaduan dan Permohonan BNNK Tulungagung</p>
                    </div>

                </div>

                <div class="sa-profile">

                    <div class="sa-profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="sa-profile-info">
                        <strong>Super Admin</strong>
                        <small>Administrator Sistem</small>
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
                            <i class="bi bi-check-circle"></i>
                            176 telah selesai
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
                        <p>Daftar akun admin yang pernah masuk ke sistem.</p>
                    </div>

                    <div class="sa-table-tools">

                        <div class="sa-search-box">
                            <i class="bi bi-search"></i>

                            <input type="search" id="adminSearch" placeholder="Cari nama atau email..." autocomplete="off">
                        </div>

                        <button type="button" class="sa-filter-button">
                            <i class="bi bi-funnel-fill"></i>
                            <span>Filter</span>
                        </button>

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
                                            title="Lihat detail">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                        <button type="button" class="sa-action-button sa-key-button" title="Reset password">

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
                                            title="Lihat detail">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                        <button type="button" class="sa-action-button sa-key-button" title="Reset password">

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

                        <button type="button" disabled>
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button type="button" class="active">1</button>

                        <button type="button">2</button>

                        <button type="button">
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
            const dashboard = document.getElementById('superAdminDashboard');
            const toggleButton = document.getElementById('toggleSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const searchInput = document.getElementById('adminSearch');
            const adminTable = document.getElementById('adminTable');

            function toggleSidebar() {
                if (window.innerWidth <= 991) {
                    dashboard.classList.toggle('mobile-sidebar-open');
                } else {
                    dashboard.classList.toggle('sidebar-collapsed');
                }
            }

            toggleButton.addEventListener('click', toggleSidebar);

            overlay.addEventListener('click', function () {
                dashboard.classList.remove('mobile-sidebar-open');
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 991) {
                    dashboard.classList.remove('mobile-sidebar-open');
                }
            });

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();
                const rows = adminTable.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    const content = row.textContent.toLowerCase();

                    row.style.display = content.includes(keyword)
                        ? ''
                        : 'none';
                });
            });
        });
    </script>

@endpush