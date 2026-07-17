@extends('layouts.admin')

@section('title', 'Dashboard Super Admin')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        {{-- Sidebar dipanggil dari satu file --}}
        @include('layouts.sidebar')

        {{-- =================================================
        KONTEN UTAMA
        ================================================== --}}
        <main class="sa-main">

            {{-- HEADER --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button type="button" class="sa-toggle-sidebar" id="toggleSidebar" aria-label="Buka atau tutup sidebar"
                        aria-controls="superAdminSidebar" aria-expanded="true">

                        <i class="bi bi-list"></i>

                    </button>

                    <div class="sa-page-heading">

                        <h1>Dashboard Super Admin</h1>

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
                            {{ auth()->user()->name ?? 'Super Admin' }}
                        </strong>

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
            {{-- <section class="sa-panel sa-admin-panel">

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

                        <a href="{{ route('superadmin.data_admin') }}" class="sa-filter-button">

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

            </section> --}}

<section class="row mt-4">

    {{-- Grafik --}}
    <div class="col-lg-9">

        <section class="sa-panel h-100">

            <div class="sa-panel-header d-flex justify-content-between align-items-center">

                <div>

                    <h3>Statistik Laporan Tahunan</h3>

                    <p>
                        Jumlah laporan berdasarkan kategori setiap bulan.
                    </p>

                </div>

                <select class="form-select"
                        style="width:120px">

                    <option>2026</option>
                    <option>2025</option>
                    <option>2024</option>

                </select>

            </div>

            <div class="p-4">

                <div style="height:400px">

                    <canvas id="chartLaporan"></canvas>

                </div>

            </div>

        </section>

    </div>

    {{-- Ringkasan --}}
    <div class="col-lg-3">

        <section class="sa-panel h-100">

            <div class="sa-panel-header">

                <h3>Ringkasan 2026</h3>

            </div>

            <div class="p-4">

                <div class="mb-4">

                    <small class="text-muted">
                        Pengaduan Narkoba
                    </small>

                    <h3 class="fw-bold text-primary">
                        260
                    </h3>

                </div>

                <div class="mb-4">

                    <small class="text-muted">
                        WBS
                    </small>

                    <h3 class="fw-bold text-warning">
                        95
                    </h3>

                </div>

                <div class="mb-4">

                    <small class="text-muted">
                        Sosialisasi
                    </small>

                    <h3 class="fw-bold text-success">
                        82
                    </h3>

                </div>

                <div>

                    <small class="text-muted">
                        Rehabilitasi
                    </small>

                    <h3 class="fw-bold text-danger">
                        73
                    </h3>

                </div>

            </div>

        </section>

    </div>

</section>





        </main>

    </section>

@endsection

@push('scripts')

    <script>
        const ctx = document.getElementById('chartLaporan');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],

        datasets: [

            {
                label: 'Pengaduan Narkoba',
                data: [15,18,21,17,22,24,20,19,25,27,24,28],
                backgroundColor:'#0B63CE',
                borderRadius:8,
                barThickness:12
            },

            {
                label:'WBS',
                data:[5,6,7,8,6,7,9,10,8,7,9,11],
                backgroundColor:'#FFC107',
                borderRadius:8,
                barThickness:12
            },

            {
                label:'Sosialisasi',
                data:[3,5,4,6,5,7,8,7,9,8,10,11],
                backgroundColor:'#36B37E',
                borderRadius:8,
                barThickness:12
            },

            {
                label:'Rehabilitasi',
                data:[4,5,6,7,8,6,9,8,10,9,11,12],
                backgroundColor:'#F45D48',
                borderRadius:8,
                barThickness:12
            }

        ]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{
                position:'bottom',
                labels:{
                    usePointStyle:true,
                    pointStyle:'circle',
                    padding:20,
                    font:{
                        size:13
                    }
                }
            }

        },

        scales:{

            x:{
                grid:{
                    display:false
                }
            },

            y:{
                beginAtZero:true,
                grid:{
                    color:'#eef2f7'
                },
                ticks:{
                    stepSize:5
                }
            }

        }

    }

});


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