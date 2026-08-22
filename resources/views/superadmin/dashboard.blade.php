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

                {{-- TOTAL PENGADUAN --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-green">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>

                    <div class="sa-stat-content">

                        <span>Total Pengaduan</span>

                        <h2>{{ $totalPengaduan }}</h2>

                        <small>
                            <i class="bi bi-clock"></i>
                            {{ $pengaduanDiproses }} sedang diproses
                        </small>

                    </div>

                </article>


                {{-- TOTAL PERMOHONAN --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-yellow">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>

                    <div class="sa-stat-content">

                        <span>Total Permohonan</span>

                        <h2>{{ $totalPermohonan }}</h2>

                        <small>
                            <i class="bi bi-envelope-check"></i>
                            Permohonan masuk
                        </small>

                    </div>

                </article>


                {{-- LAPORAN SELESAI --}}
                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-green">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <div class="sa-stat-content">

                        <span>Laporan Selesai</span>

                        <h2>{{ $laporanSelesai }}</h2>

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

            <section class="row mt-4">

                {{-- =========================================================
                GRAFIK LAPORAN
                ========================================================== --}}
                <div class="col-lg-9">

                    <section class="sa-panel h-100">

                        {{-- HEADER --}}
                        <div class="sa-panel-header d-flex justify-content-between align-items-center">

                            <div>

                                <h3>Statistik Laporan Tahunan</h3>

                                <p>
                                    Jumlah laporan berdasarkan kategori setiap bulan
                                    pada tahun {{ $tahun }}.
                                </p>

                            </div>


                            {{-- FILTER TAHUN --}}
                            <form method="GET" action="{{ route('superadmin.dashboard') }}">

                                <select name="tahun" class="form-select" style="width:120px" onchange="this.form.submit()">

                                    <option value="2026" {{ $tahun == 2026 ? 'selected' : '' }}>
                                        2026
                                    </option>

                                    <option value="2025" {{ $tahun == 2025 ? 'selected' : '' }}>
                                        2025
                                    </option>

                                    <option value="2024" {{ $tahun == 2024 ? 'selected' : '' }}>
                                        2024
                                    </option>

                                </select>

                            </form>

                        </div>


                        {{-- AREA GRAFIK --}}
                        <div class="p-4">

                            <div style="height:400px">

                                <canvas id="chartLaporan"></canvas>

                            </div>

                        </div>

                    </section>

                </div>



                {{-- =========================================================
                RINGKASAN
                ========================================================== --}}
                <div class="col-lg-3">

                    <section class="sa-panel h-100">

                        <div class="sa-panel-header">

                            <h3>
                                Ringkasan {{ $tahun }}
                            </h3>

                        </div>

                        <div class="p-4">

                            {{-- TOTAL PENGADUAN --}}
                            <div class="mb-4">

                                <small class="text-muted">
                                    Total Pengaduan
                                </small>

                                <h3 class="fw-bold text-primary mb-0">
                                    {{ number_format(
        $totalPengaduanTahun,
        0,
        ',',
        '.'
    ) }}
                                </h3>

                            </div>


                            {{-- TOTAL PERMOHONAN --}}
                            <div class="mb-4">

                                <small class="text-muted">
                                    Total Permohonan
                                </small>

                                <h3 class="fw-bold text-warning mb-0">
                                    {{ number_format(
        $totalPermohonanTahun,
        0,
        ',',
        '.'
    ) }}
                                </h3>

                            </div>


                            {{-- PENGADUAN DIPROSES --}}
                            {{-- <div class="mb-4">

                                <small class="text-muted">
                                    Pengaduan Diproses
                                </small>

                                <h3 class="fw-bold text-info mb-0">
                                    {{ number_format(
        $pengaduanDiprosesTahun,
        0,
        ',',
        '.'
    ) }}
                                </h3>

                            </div> --}}


                            {{-- LAPORAN SELESAI --}}
                            <div>

                                <small class="text-muted">
                                    Laporan Selesai
                                </small>

                                <h3 class="fw-bold text-success mb-0">
                                    {{ number_format(
        $laporanSelesaiTahun,
        0,
        ',',
        '.'
    ) }}
                                </h3>

                            </div>

                        </div>

                    </section>

                </div>

            </section>



            {{-- =========================================================
            CHART.JS
            ========================================================= --}}

          

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>

    const labelsBulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];


    const dataPengaduan = @json(array_values($grafikPengaduan));

    const dataPermohonan = @json(array_values($grafikPermohonan));


    const ctx = document
        .getElementById('chartLaporan')
        .getContext('2d');


    new Chart(ctx, {

        type: 'line',

        data: {

            labels: labelsBulan,

            datasets: [

                {
                    label: 'Pengaduan',

                    data: dataPengaduan,

                    borderWidth: 3,

                    tension: 0.35,

                    fill: false,

                    pointRadius: 4,

                    pointHoverRadius: 6
                },


                {
                    label: 'Permohonan',

                    data: dataPermohonan,

                    borderWidth: 3,

                    tension: 0.35,

                    fill: false,

                    pointRadius: 4,

                    pointHoverRadius: 6
                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,


            interaction: {

                intersect: false,

                mode: 'index'

            },


            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        stepSize: 1

                    },

                    title: {

                        display: true,

                        text: 'Jumlah'

                    }

                },


                x: {

                    title: {

                        display: true,

                        text: 'Bulan'

                    }

                }

            },


            plugins: {

                legend: {

                    position: 'bottom'

                },


                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return context.dataset.label
                                + ': '
                                + context.parsed.y
                                + ' laporan';

                        }

                    }

                }

            }

        }

    });

</script>




        </main>

    </section>

@endsection

@push('scripts')

    <script>
        const ctx = document.getElementById('chartLaporan');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],

                datasets: [

                    {
                        label: 'Pengaduan Narkoba',
                        data: [15, 18, 21, 17, 22, 24, 20, 19, 25, 27, 24, 28],
                        backgroundColor: '#0B63CE',
                        borderRadius: 8,
                        barThickness: 12
                    },

                    {
                        label: 'WBS',
                        data: [5, 6, 7, 8, 6, 7, 9, 10, 8, 7, 9, 11],
                        backgroundColor: '#FFC107',
                        borderRadius: 8,
                        barThickness: 12
                    },

                    {
                        label: 'Sosialisasi',
                        data: [3, 5, 4, 6, 5, 7, 8, 7, 9, 8, 10, 11],
                        backgroundColor: '#36B37E',
                        borderRadius: 8,
                        barThickness: 12
                    },

                    {
                        label: 'Rehabilitasi',
                        data: [4, 5, 6, 7, 8, 6, 9, 8, 10, 9, 11, 12],
                        backgroundColor: '#F45D48',
                        borderRadius: 8,
                        barThickness: 12
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: {
                                size: 13
                            }
                        }
                    }

                },

                scales: {

                    x: {
                        grid: {
                            display: false
                        }
                    },

                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#eef2f7'
                        },
                        ticks: {
                            stepSize: 5
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