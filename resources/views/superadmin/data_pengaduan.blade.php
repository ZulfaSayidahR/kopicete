@extends('layouts.app')

@section('title', 'Data Pengaduan')

@section('content')

    <section class="sa-dashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- ================= HEADER ================= --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar" id="toggleSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">
                        <h1>Data Pengaduan</h1>
                        <p>Kelola dan tindak lanjut seluruh pengaduan masyarakat.</p>
                    </div>

                </div>

                <div class="sa-profile">

                    <div class="sa-profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="sa-profile-info">
                        <strong>{{ auth()->user()->name ?? 'Admin BNNK' }}</strong>
                        <small>Administrator</small>
                    </div>

                </div>

            </header>



            {{-- ================= FILTER ================= --}}

            <section class="sa-panel mt-4">

                <div class="sa-panel-header">

                    <div>

                        <h3>Filter Pengaduan</h3>

                        <p>Cari berdasarkan token, kategori, kecamatan maupun status.</p>

                    </div>

                </div>

                <div class="p-4">

                    <div class="row g-3">

                        <div class="col-lg-6">

                            <div class="sa-search-box w-100">

                                <i class="bi bi-search"></i>

                                <input type="text" placeholder="Cari Token atau Judul Aduan">

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Kategori</option>

                                <option>Penyalahgunaan Narkoba</option>

                                <option>Whistle Blowing System</option>

                            </select>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Kecamatan</option>

                                <option>Campurdarat</option>

                                <option>Kauman</option>

                                <option>Tulungagung</option>

                            </select>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Status</option>

                                <option>Diajukan</option>

                                <option>Diverifikasi</option>

                                <option>Diproses</option>

                                <option>Selesai</option>

                            </select>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ================= TABEL ================= --}}

            <section class="sa-panel mt-4">

                <div class="sa-panel-header">

                    <div>

                        <h3>Daftar Pengaduan</h3>

                        <p>Data pengaduan masyarakat yang masuk ke sistem.</p>

                    </div>

                </div>

                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>Kode Aduan</th>

                                <th>Kategori</th>

                                <th>Kecamatan</th>

                                <th>Tanggal</th>

                                <th>Status</th>

                                <th class="sa-action-column">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>PHGSHJBJ</td>

                                <td>Penyalahgunaan</td>

                                <td>Campurdarat</td>

                                <td>21/12/2025</td>

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

                                        <button class="sa-action-button sa-key-button">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>PHGSHJBJ</td>

                                <td>WBS</td>

                                <td>Kauman</td>

                                <td>23/05/2026</td>

                                <td>

                                    <span class="sa-status-badge">

                                        <span style="background:#ffc107"></span>

                                        Diverifikasi

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                        <button class="sa-action-button sa-key-button">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>SAAFDGD</td>

                                <td>WBS</td>

                                <td>Tulungagung</td>

                                <td>22/03/2026</td>

                                <td>

                                    <span class="sa-status-badge">

                                        <span style="background:#0d6efd"></span>

                                        Diajukan

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                        <button class="sa-action-button sa-key-button">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>BNNK001</td>

                                <td>Penyalahgunaan</td>

                                <td>Bandung</td>

                                <td>01/07/2026</td>

                                <td>

                                    <span class="sa-status-badge">

                                        <span style="background:#fd7e14"></span>

                                        Diproses

                                    </span>

                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <button class="sa-action-button sa-detail-button">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                        <button class="sa-action-button sa-key-button">

                                            <i class="bi bi-pencil-square"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="sa-table-footer">

                    <span>Menampilkan 4 dari 4 pengaduan</span>

                    <div class="sa-pagination">

                        <button disabled>
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button class="active">1</button>

                        <button>
                            <i class="bi bi-chevron-right"></i>
                        </button>

                    </div>

                </div>

            </section>

        </main>

    </section>

@endsection