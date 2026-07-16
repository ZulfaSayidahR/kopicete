@extends('layouts.admin')

@section('title', 'Data Permohonan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar')

        <main class="sa-main">
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle-fill"></i>

                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            {{-- ================= HEADER ================= --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar" id="toggleSidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">
                        <h1>Data Permohonan</h1>
                        <p>Kelola seluruh permohonan layanan masyarakat BNNK Tulungagung.</p>
                    </div>

                </div>

                <div class="sa-profile">

                    <div class="sa-profile-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="sa-profile-info">
                        <strong>{{ auth()->user()->name ?? 'Super Admin' }}</strong>
                        <small>Administrator Sistem</small>
                    </div>

                </div>

            </header>

            {{-- ================= FILTER ================= --}}

            <section class="sa-panel mt-4">

                <div class="sa-panel-header">

                    <div>
                        <h3>Filter Permohonan</h3>
                        <p>Cari permohonan berdasarkan token, nama pemohon maupun status.</p>
                    </div>

                </div>

                <div class="p-4">

                    <div class="row g-3">

                        <div class="col-lg-6">

                            <div class="sa-search-box w-100">

                                <i class="bi bi-search"></i>

                                <input type="text" placeholder="Cari Token atau Nama Pemohon">

                            </div>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Jenis Permohonan</option>
                                <option>Permohonan Rehabilitasi</option>
                                <option>Permohonan Sosialisasi</option>

                            </select>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Kecamatan</option>
                                <option>Tulungagung</option>
                                <option>Campurdarat</option>
                                <option>Kauman</option>
                                <option>Ngunut</option>
                                <option>Boyolangu</option>

                            </select>

                        </div>

                        <div class="col-lg-6">

                            <select class="form-select">

                                <option>Semua Status</option>
                                <option>Menunggu Verifikasi</option>
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

                        <h3>Daftar Permohonan</h3>

                        <p>Seluruh data permohonan yang telah dikirim masyarakat.</p>

                    </div>

                </div>

                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>Token</th>
                                <th>Jenis Permohonan</th>
                                <th>Nama Pemohon</th>
                                <th>Kecamatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="sa-action-column">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>PMH-001</td>
                                <td>Permohonan Rehabilitasi</td>
                                <td>Ahmad Fauzi</td>
                                <td>Campurdarat</td>
                                <td>16 Juli 2026</td>

                                <td>
                                    <span class="sa-status-badge">
                                        <span style="background:#ffc107"></span>
                                        Menunggu Verifikasi
                                    </span>
                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        {{-- Detail / Edit --}}
                                        <a href="{{ route('superadmin.detail_permohonan') }}"
                                            class="sa-action-button sa-key-button" title="Detail Permohonan">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <button class="sa-action-button sa-delete-button"
                                            onclick="return confirm('Yakin ingin menghapus data permohonan ini?')"
                                            title="Hapus">

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>PMH-002</td>
                                <td>Permohonan Sosialisasi</td>
                                <td>SMAN 1 Tulungagung</td>
                                <td>Tulungagung</td>
                                <td>18 Juli 2026</td>

                                <td>
                                    <span class="sa-status-badge">
                                        <span style="background:#0d6efd"></span>
                                        Diproses
                                    </span>
                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <a href="{{ route('superadmin.detail_permohonan') }}"
                                            class="sa-action-button sa-key-button" title="Detail Permohonan">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button class="sa-action-button sa-delete-button"
                                            onclick="return confirm('Yakin ingin menghapus data permohonan ini?')"
                                            title="Hapus">

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            <tr>

                                <td>PMH-003</td>
                                <td>Permohonan Rehabilitasi</td>
                                <td>Siti Aminah</td>
                                <td>Kauman</td>
                                <td>20 Juli 2026</td>

                                <td>
                                    <span class="sa-status-badge active">
                                        <span></span>
                                        Selesai
                                    </span>
                                </td>

                                <td>

                                    <div class="sa-action-buttons">

                                        <a href="{{ route('superadmin.detail_permohonan') }}"
                                            class="sa-action-button sa-key-button" title="Detail Permohonan">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <button class="sa-action-button sa-delete-button"
                                            onclick="return confirm('Yakin ingin menghapus data permohonan ini?')"
                                            title="Hapus">

                                            <i class="bi bi-trash-fill"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="sa-table-footer">

                    <span>Menampilkan 3 dari 3 permohonan</span>

                    <div class="sa-pagination">

                        <button disabled>
                            <i class="bi bi-chevron-left"></i>
                        </button>

                        <button class="active">1</button>

                        <button disabled>
                            <i class="bi bi-chevron-right"></i>
                        </button>

                    </div>

                </div>

            </section>

        </main>

    </section>

@endsection