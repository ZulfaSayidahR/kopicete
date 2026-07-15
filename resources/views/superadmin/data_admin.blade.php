@extends('layouts.app')

@section('title', 'Data Admin')

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

                    <li class="sa-menu-item
                            {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">

                        <a href="{{ route('superadmin.dashboard') }}">

                            <i class="bi bi-grid-fill"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>

                    <li class="sa-menu-item
                            {{ request()->routeIs('superadmin.data-admin') ? 'active' : '' }}">

                        <a href="{{ route('superadmin.data-admin') }}">

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

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="sa-logout">

                        <i class="bi bi-box-arrow-left"></i>

                        <span>Keluar</span>

                    </button>

                </form>

            </div>

        </aside>

        {{-- Overlay sidebar untuk perangkat mobile --}}
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

                        <h1>Data Admin</h1>

                        <p>
                            Kelola dan pantau seluruh akun admin BNNK Tulungagung
                        </p>

                    </div>

                </div>

                <div class="sa-profile">

                    <div class="sa-profile-avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div class="sa-profile-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Super Admin' }}
                        </strong>

                        <small>Administrator Sistem</small>

                    </div>

                    <i class="bi bi-chevron-down sa-profile-arrow"></i>

                </div>

            </header>

            {{-- =================================================
            STATISTIK DATA ADMIN
            ================================================== --}}
            <section class="sa-statistics">

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-blue">

                        <i class="bi bi-people-fill"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Total Admin</span>

                        <h2>{{ number_format($totalAdmin) }}</h2>

                        <small>

                            <i class="bi bi-database-check"></i>

                            Seluruh akun terdaftar

                        </small>

                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-green">

                        <i class="bi bi-person-check-fill"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Admin Aktif</span>

                        <h2>{{ number_format($adminAktif) }}</h2>

                        <small>

                            <i class="bi bi-check-circle-fill"></i>

                            Dapat mengakses sistem

                        </small>

                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-red">

                        <i class="bi bi-google"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Login Google</span>

                        <h2>{{ number_format($loginGoogle) }}</h2>

                        <small>

                            <i class="bi bi-shield-check"></i>

                            Akun Google terhubung

                        </small>

                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-yellow">

                        <i class="bi bi-person-plus-fill"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Admin Baru</span>

                        <h2>{{ number_format($adminBaru) }}</h2>

                        <small>

                            <i class="bi bi-calendar3"></i>

                            Terdaftar bulan ini

                        </small>

                    </div>

                </article>

            </section>

            {{-- =================================================
            INFORMASI
            ================================================== --}}
            <section class="sa-admin-information">

                <div class="sa-admin-information-icon">

                    <i class="bi bi-info-circle-fill"></i>

                </div>

                <div>

                    <strong>Pendaftaran admin otomatis</strong>

                    <p>
                        Admin yang berhasil masuk melalui Google akan tercatat
                        otomatis pada halaman ini.
                    </p>

                </div>

            </section>

            {{-- =================================================
            TABEL DATA ADMIN
            ================================================== --}}
            <section class="sa-panel sa-admin-panel">

                <div class="sa-panel-header sa-admin-page-header">

                    <div>

                        <h3>Daftar Admin Terdaftar</h3>

                        <p>
                            Cari admin berdasarkan nama, email, status, atau
                            metode login.
                        </p>

                    </div>

                    <form action="{{ route('superadmin.data-admin') }}" method="GET" class="sa-admin-filter-form">

                        <div class="sa-search-box">

                            <i class="bi bi-search"></i>

                            <input type="search" name="search" value="{{ $search }}" placeholder="Cari nama atau email..."
                                autocomplete="off">

                        </div>

                        <select name="status" class="sa-filter-select" aria-label="Filter status admin">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="aktif" @selected($status === 'aktif')>

                                Aktif

                            </option>

                            <option value="nonaktif" @selected($status === 'nonaktif')>

                                Nonaktif

                            </option>

                        </select>

                        <select name="login" class="sa-filter-select" aria-label="Filter metode login">

                            <option value="">
                                Semua Login
                            </option>

                            <option value="google" @selected($login === 'google')>

                                Google

                            </option>

                            <option value="manual" @selected($login === 'manual')>

                                Manual

                            </option>

                        </select>

                        <button type="submit" class="sa-filter-submit">

                            <i class="bi bi-funnel-fill"></i>

                            <span>Terapkan</span>

                        </button>

                        @if ($search !== '' || $status !== '' || $login !== '')

                            <a href="{{ route('superadmin.data-admin') }}" class="sa-reset-filter" title="Hapus filter">

                                <i class="bi bi-arrow-counterclockwise"></i>

                            </a>

                        @endif

                    </form>

                </div>

                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>Admin</th>

                                <th>Email</th>

                                <th>Metode Login</th>

                                <th>Tanggal Terdaftar</th>

                                <th>Status</th>

                                <th class="sa-action-column">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($admins as $admin)

                                @php
                                    $provider = strtolower(
                                        (string) ($admin->provider ?? '')
                                    );

                                    $isGoogle =
                                        $provider === 'google' ||
                                        !empty($admin->google_id);

                                    $statusValue = strtolower(
                                        (string) ($admin->status ?? 'aktif')
                                    );

                                    $isActive = in_array(
                                        $statusValue,
                                        ['aktif', 'active', '1'],
                                        true
                                    ) || $admin->status === 1;

                                    $initial = strtoupper(
                                        substr($admin->name ?? 'A', 0, 1)
                                    );
                                @endphp

                                <tr>

                                    <td>

                                        <div class="sa-admin-user">

                                            @if (!empty($admin->avatar))

                                                <img src="{{ $admin->avatar }}" alt="{{ $admin->name }}"
                                                    class="sa-admin-avatar-image">

                                            @else

                                                <div class="sa-admin-avatar">

                                                    {{ $initial }}

                                                </div>

                                            @endif

                                            <div>

                                                <strong>
                                                    {{ $admin->name }}
                                                </strong>

                                                <small>
                                                    Admin BNNK
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="sa-email-text">

                                            {{ $admin->email }}

                                        </span>

                                    </td>

                                    <td>

                                        @if ($isGoogle)

                                            <span class="sa-login-badge google">

                                                <i class="bi bi-google"></i>

                                                Google

                                            </span>

                                        @else

                                            <span class="sa-login-badge manual">

                                                <i class="bi bi-key-fill"></i>

                                                Manual

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        {{ optional($admin->created_at)->format('d M Y') ?? '-' }}

                                    </td>

                                    <td>

                                        @if ($isActive)

                                            <span class="sa-status-badge active">

                                                <span></span>

                                                Aktif

                                            </span>

                                        @else

                                            <span class="sa-status-badge inactive">

                                                <span></span>

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="sa-action-buttons">

                                            <button type="button" class="sa-action-button sa-detail-button"
                                                title="Lihat detail admin">

                                                <i class="bi bi-eye-fill"></i>

                                            </button>

                                            <button type="button" class="sa-action-button sa-key-button"
                                                title="Reset password admin">

                                                <i class="bi bi-key-fill"></i>

                                            </button>

                                            <button type="button" class="sa-action-button sa-more-button"
                                                title="Pilihan lainnya">

                                                <i class="bi bi-three-dots-vertical"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6">

                                        <div class="sa-empty-state">

                                            <div class="sa-empty-icon">

                                                <i class="bi bi-people"></i>

                                            </div>

                                            <h4>Data admin tidak ditemukan</h4>

                                            <p>
                                                Belum ada akun admin atau data tidak
                                                sesuai dengan pencarian.
                                            </p>

                                            @if (
                                                    $search !== '' ||
                                                    $status !== '' ||
                                                    $login !== ''
                                                )

                                                <a href="{{ route('superadmin.data-admin') }}">

                                                    Hapus filter

                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="sa-table-footer">

                    <span>

                        Menampilkan

                        <strong>
                            {{ $admins->firstItem() ?? 0 }}
                        </strong>

                        sampai

                        <strong>
                            {{ $admins->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $admins->total() }}
                        </strong>

                        admin

                    </span>

                    <div class="sa-pagination-wrapper">

                        {{ $admins->links() }}

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

            const sidebarStorageKey = 'superadmin-sidebar-collapsed';

            /*
            |--------------------------------------------------------------------------
            | Mengembalikan status sidebar desktop
            |--------------------------------------------------------------------------
            */

            if (
                window.innerWidth > 991 &&
                localStorage.getItem(sidebarStorageKey) === 'true'
            ) {
                dashboard.classList.add('sidebar-collapsed');
            }

            /*
            |--------------------------------------------------------------------------
            | Tombol sidebar
            |--------------------------------------------------------------------------
            */

            toggleButton.addEventListener('click', function () {
                if (window.innerWidth <= 991) {
                    dashboard.classList.toggle('mobile-sidebar-open');
                    return;
                }

                dashboard.classList.toggle('sidebar-collapsed');

                localStorage.setItem(
                    sidebarStorageKey,
                    dashboard.classList.contains('sidebar-collapsed')
                );
            });

            /*
            |--------------------------------------------------------------------------
            | Overlay sidebar mobile
            |--------------------------------------------------------------------------
            */

            overlay.addEventListener('click', function () {
                dashboard.classList.remove('mobile-sidebar-open');
            });

            /*
            |--------------------------------------------------------------------------
            | Menyesuaikan sidebar ketika ukuran layar berubah
            |--------------------------------------------------------------------------
            */

            window.addEventListener('resize', function () {
                if (window.innerWidth > 991) {
                    dashboard.classList.remove('mobile-sidebar-open');
                }
            });
        });
    </script>

@endpush