@extends('layouts.admin')

@section('title', 'Dashboard Admin Pengaduan')

@section('content')

<section class="sa-dashboard" id="superAdminDashboard">

    {{-- Sidebar --}}
    @include('layouts.sidebar_admin_pengaduan')

    <main class="sa-main">

        {{-- HEADER --}}
        <header class="sa-topbar">

            <div class="sa-topbar-left">

                <button type="button"
                        class="sa-toggle-sidebar"
                        id="toggleSidebar">

                    <i class="bi bi-list"></i>

                </button>

                <div class="sa-page-heading">

                    <h1>Dashboard Admin Pengaduan</h1>

                    <p>
                        Monitoring seluruh pengaduan masyarakat
                        BNNK Tulungagung
                    </p>

                </div>

            </div>

            <div class="sa-profile">

                <div class="sa-profile-avatar">

                    <i class="bi bi-person-fill"></i>

                </div>

                <div class="sa-profile-info">

                    <strong>{{ auth()->user()->name ?? 'Admin Pengaduan' }}</strong>

                    <small>Administrator</small>

                </div>

                <i class="bi bi-chevron-down sa-profile-arrow"></i>

            </div>

        </header>

        {{-- CARD STATISTIK --}}
        <section class="sa-statistics">

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">

                    <i class="bi bi-file-earmark-text-fill"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Total Pengaduan</span>

                    <h2>530</h2>

                    <small>Seluruh laporan masyarakat</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-yellow">

                    <i class="bi bi-hourglass-split"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Menunggu Verifikasi</span>

                    <h2>18</h2>

                    <small>Belum diverifikasi</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">

                    <i class="bi bi-arrow-repeat"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Diproses</span>

                    <h2>42</h2>

                    <small>Sedang ditindaklanjuti</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-green">

                    <i class="bi bi-check-circle-fill"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Selesai</span>

                    <h2>470</h2>

                    <small>Laporan selesai</small>

                </div>

            </article>

        </section>

        {{-- TABEL --}}
        <section class="sa-panel sa-admin-panel">

            <div class="sa-panel-header">

                <div>

                    <h3>Pengaduan Terbaru</h3>

                    <p>
                        Daftar pengaduan terbaru yang masuk ke sistem.
                    </p>

                </div>

                <div class="sa-table-tools">

                    <div class="sa-search-box">

                        <i class="bi bi-search"></i>

                        <input type="search"
                               placeholder="Cari kode atau pelapor...">

                    </div>

                    <a href="{{ route('adminpengaduan.data_pengaduan') }}"
                       class="sa-filter-button">

                        <i class="bi bi-folder-fill"></i>

                        <span>Lihat Semua</span>

                    </a>

                </div>

            </div>

            <div class="sa-table-responsive">

                <table class="sa-table">

                    <thead>

                    <tr>

                        <th>Kode</th>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="sa-action-column">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <tr>

                        <td>ADU001</td>

                        <td>Anonim</td>

                        <td>Penyalahgunaan</td>

                        <td>15 Juli 2026</td>

                        <td>

                            <span class="sa-status-badge active">

                                <span></span>

                                Diproses

                            </span>

                        </td>

                        <td>

                            <button class="sa-action-button sa-detail-button">

                                <i class="bi bi-eye-fill"></i>

                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>ADU002</td>

                        <td>Ahmad</td>

                        <td>WBS</td>

                        <td>14 Juli 2026</td>

                        <td>

                            <span class="sa-status-badge active">

                                <span></span>

                                Selesai

                            </span>

                        </td>

                        <td>

                            <button class="sa-action-button sa-detail-button">

                                <i class="bi bi-eye-fill"></i>

                            </button>

                        </td>

                    </tr>

                    </tbody>

                </table>

            </div>

            <div class="sa-table-footer">

                <span>Menampilkan 2 dari 530 pengaduan</span>

                <div class="sa-pagination">

                    <button disabled>

                        <i class="bi bi-chevron-left"></i>

                    </button>

                    <button class="active">1</button>

                    <button>2</button>

                    <button>

                        <i class="bi bi-chevron-right"></i>

                    </button>

                </div>

            </div>

        </section>

    </main>

</section>

@endsection