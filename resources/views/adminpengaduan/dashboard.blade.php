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

                    <button type="button" class="sa-toggle-sidebar" id="toggleSidebar">

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

                {{-- TOTAL --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-blue">

                        <i class="bi bi-file-earmark-text-fill"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Total Pengaduan</span>

                        <h2>
                            {{ $totalPengaduan }}
                        </h2>

                        <small>
                            Seluruh laporan masyarakat
                        </small>

                    </div>

                </article>


                {{-- MENUNGGU --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-yellow">

                        <i class="bi bi-hourglass-split"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Menunggu Verifikasi</span>

                        <h2>
                            {{ $menungguVerifikasi }}
                        </h2>

                        <small>
                            Belum diverifikasi
                        </small>

                    </div>

                </article>


                {{-- DIPROSES --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-blue">

                        <i class="bi bi-arrow-repeat"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Diproses</span>

                        <h2>
                            {{ $diproses }}
                        </h2>

                        <small>
                            Sedang ditindaklanjuti
                        </small>

                    </div>

                </article>


                {{-- SELESAI --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-green">

                        <i class="bi bi-check-circle-fill"></i>

                    </div>

                    <div class="sa-stat-content">

                        <span>Selesai</span>

                        <h2>
                            {{ $selesai }}
                        </h2>

                        <small>
                            Laporan selesai
                        </small>

                    </div>

                </article>

            </section>

            {{-- TABEL --}}
            {{-- =========================================================
            | TABEL PENGADUAN TERBARU
            ========================================================= --}}

            <section class="sa-panel sa-admin-panel">

                {{-- HEADER --}}
                <div class="sa-panel-header">

                    <div>

                        <h3>
                            Pengaduan Terbaru
                        </h3>

                        <p>
                            Daftar pengaduan terbaru yang masuk ke sistem.
                        </p>

                    </div>


                    <div class="sa-table-tools">

                        {{-- SEARCH --}}
                        <div class="sa-search-box">

                            <i class="bi bi-search"></i>

                            <input type="search" placeholder="Cari kode atau judul aduan...">

                        </div>


                        {{-- LIHAT SEMUA --}}
                        <a href="{{ route('adminpengaduan.data_pengaduan') }}" class="sa-filter-button">

                            <i class="bi bi-folder-fill"></i>

                            <span>
                                Lihat Semua
                            </span>

                        </a>

                    </div>

                </div>


                {{-- =========================================================
                | TABEL
                ========================================================== --}}

                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>
                                    Kode Aduan
                                </th>

                                <th>
                                    Judul Aduan
                                </th>

                                <th>
                                    Kategori
                                </th>

                                <th>
                                    Kecamatan
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="sa-action-column">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($pengaduanTerbaru as $pengaduan)

                                                    <tr>

                                                        {{-- =====================================
                                                        KODE ADUAN
                                                        ====================================== --}}
                                                        <td>

                                                            <strong>
                                                                {{ $pengaduan->kode_aduan ?? '-' }}
                                                            </strong>

                                                        </td>


                                                        {{-- =====================================
                                                        JUDUL ADUAN
                                                        ====================================== --}}
                                                        <td>

                                                            {{ $pengaduan->judul_aduan ?? '-' }}

                                                        </td>


                                                        {{-- =====================================
                                                        KATEGORI / TOPIK
                                                        ====================================== --}}
                                                        <td>

                                                            {{ $pengaduan->topik_aduan ?? '-' }}

                                                        </td>


                                                        {{-- =====================================
                                                        KECAMATAN
                                                        ====================================== --}}
                                                        <td>

                                                            {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}

                                                        </td>


                                                        {{-- =====================================
                                                        TANGGAL
                                                        ====================================== --}}
                                                        <td>

                                                            @if($pengaduan->created_at)

                                                                {{ $pengaduan->created_at->format('d/m/Y') }}

                                                            @else

                                                                -

                                                            @endif

                                                        </td>


                                                        {{-- =====================================
                                                        STATUS
                                                        ====================================== --}}
                                                        <td>

                                                            @if($pengaduan->status === 'Menunggu')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#0d6efd"></span>

                                                                    Menunggu

                                                                </span>


                                                            @elseif($pengaduan->status === 'Diverifikasi')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#0d6efd"></span>

                                                                    Diverifikasi

                                                                </span>


                                                            @elseif($pengaduan->status === 'Diproses')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#fd7e14"></span>

                                                                    Diproses

                                                                </span>


                                                            @elseif($pengaduan->status === 'Diproses Lapangan')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#fd7e14"></span>

                                                                    Diproses Lapangan

                                                                </span>


                                                            @elseif($pengaduan->status === 'Selesai')

                                                                <span class="sa-status-badge active">

                                                                    <span></span>

                                                                    Selesai

                                                                </span>


                                                            @elseif($pengaduan->status === 'Ditolak')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#dc3545"></span>

                                                                    Ditolak

                                                                </span>


                                                            @else

                                                                <span class="sa-status-badge">

                                                                    <span></span>

                                                                    {{ $pengaduan->status ?? '-' }}

                                                                </span>

                                                            @endif

                                                        </td>


                                                        {{-- =====================================
                                                        AKSI
                                                        ====================================== --}}
                                                        {{-- =================================================
                                                        AKSI
                                                        ================================================= --}}

                                                        <td>

                                                            <div class="sa-action-buttons">


                                                                {{-- DETAIL --}}
                                                                <a href="{{ route(
                                    'adminpengaduan.detail_pengaduan',
                                    $pengaduan->id
                                ) }}" class="sa-action-button sa-key-button" title="Lihat Detail">

                                                                    <i class="bi bi-pencil-square"></i>

                                                                </a>



                                                                {{-- HAPUS --}}
                                                                <form action="{{ route(
                                    'adminpengaduan.delete_pengaduan',
                                    $pengaduan->id
                                ) }}" method="POST" style="display:inline;">

                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit" class="sa-action-button sa-delete-button"
                                                                        title="Hapus Pengaduan" onclick="return confirm(
                                                'Yakin ingin menghapus data pengaduan ini?'
                                            )">

                                                                        <i class="bi bi-trash-fill"></i>

                                                                    </button>

                                                                </form>


                                                            </div>

                                                        </td>
                                                    </tr>
                            @empty

                                {{-- =====================================
                                DATA KOSONG
                                ====================================== --}}
                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="bi bi-inbox" style="font-size:40px"></i>

                                        <div class="mt-2">

                                            Belum ada data pengaduan.

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =========================================================
                | FOOTER
                ========================================================== --}}

                <div class="sa-table-footer">

                    <span>

                        Menampilkan

                        <strong>
                            {{ $pengaduanTerbaru->count() }}
                        </strong>

                        dari

                        <strong>
                            {{ $totalPengaduan }}
                        </strong>

                        pengaduan

                    </span>


                    <div>

                        <a href="{{ route('adminpengaduan.data_pengaduan') }}" class="sa-filter-button">

                            Lihat Semua Pengaduan

                            <i class="bi bi-arrow-right ms-1"></i>

                        </a>

                    </div>

                </div>

            </section>

        </main>

    </section>

@endsection