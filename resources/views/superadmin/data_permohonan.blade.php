@extends('layouts.app')

@section('title', 'Data Permohonan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- Header --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar" id="toggleSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">
                        <h1>Data Permohonan</h1>
                        <p>Kelola seluruh data permohonan masyarakat.</p>
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

                </div>

            </header>

            {{-- Filter --}}
            <section class="sa-panel" style="margin-top:25px;">

                <div class="sa-panel-header">

                    <div>

                        <h3>Filter Permohonan</h3>

                        <p>
                            Cari dan filter data permohonan masyarakat.
                        </p>

                    </div>

                </div>

                <div style="padding:25px;">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <input type="text" class="form-control" placeholder="Cari Token atau Judul Permohonan">

                        </div>

                        <div class="col-md-6">

                            <select class="form-select">

                                <option>Semua Jenis Permohonan</option>
                                <option>Rehabilitasi</option>
                                <option>Narasumber</option>
                                <option>Sosialisasi</option>
                                <option>Konsultasi</option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <select class="form-select">

                                <option>Semua Kecamatan</option>
                                <option>Tulungagung</option>
                                <option>Campurdarat</option>
                                <option>Kauman</option>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <select class="form-select">

                                <option>Semua Status</option>
                                <option>Menunggu</option>
                                <option>Diproses</option>
                                <option>Selesai</option>

                            </select>

                        </div>

                    </div>

                </div>

            </section>

            {{-- Tabel --}}
            <section class="sa-panel" style="margin-top:25px;">

                <div class="sa-panel-header">

                    <div>

                        <h3>Daftar Permohonan</h3>

                        <p>Data permohonan masyarakat.</p>

                    </div>

                </div>

                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>Kode</th>
                                <th>Jenis Permohonan</th>
                                <th>Pemohon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>PMH001</td>
                                <td>Rehabilitasi</td>
                                <td>Ahmad Fauzi</td>
                                <td>15 Juli 2026</td>

                                <td>

                                    <span class="sa-status-badge active">

                                        <span></span>

                                        Diproses

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>PMH002</td>
                                <td>Sosialisasi</td>
                                <td>Siti Aminah</td>
                                <td>16 Juli 2026</td>

                                <td>

                                    <span class="sa-status-badge active">

                                        <span></span>

                                        Menunggu

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>PMH003</td>
                                <td>Narasumber</td>
                                <td>SMAN 1 Tulungagung</td>
                                <td>18 Juli 2026</td>

                                <td>

                                    <span class="sa-status-badge active">

                                        <span></span>

                                        Selesai

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>

        </main>

    </section>

@endsection