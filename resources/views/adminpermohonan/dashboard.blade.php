@extends('layouts.admin')

@section('title', 'Dashboard Admin Permohonan')

@section('content')

<section class="sa-dashboard" id="superAdminDashboard">

    {{-- Sidebar --}}
    @include('layouts.sidebar_admin_permohonan')

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

                    <h1>Dashboard Admin Permohonan</h1>

                    <p>
                        Monitoring seluruh permohonan masyarakat
                        BNNK Tulungagung
                    </p>

                </div>

            </div>

            <div class="sa-profile">

                <div class="sa-profile-avatar">

                    <i class="bi bi-person-fill"></i>

                </div>

                <div class="sa-profile-info">

                    <strong>{{ auth()->user()->name ?? 'Admin Permohonan' }}</strong>

                    <small>Administrator</small>

                </div>

                <i class="bi bi-chevron-down sa-profile-arrow"></i>

            </div>

        </header>

        {{-- CARD STATISTIK --}}
        <section class="sa-statistics">

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">

                    <i class="bi bi-envelope-paper-fill"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Total Permohonan</span>

                    <h2>200</h2>

                    <small>Seluruh permohonan masyarakat</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-yellow">

                    <i class="bi bi-hourglass-split"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Menunggu Verifikasi</span>

                    <h2>15</h2>

                    <small>Belum diverifikasi</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-blue">

                    <i class="bi bi-arrow-repeat"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Sedang Diproses</span>

                    <h2>28</h2>

                    <small>Sedang ditindaklanjuti</small>

                </div>

            </article>

            <article class="sa-stat-card">

                <div class="sa-stat-icon sa-stat-green">

                    <i class="bi bi-check-circle-fill"></i>

                </div>

                <div class="sa-stat-content">

                    <span>Selesai</span>

                    <h2>157</h2>

                    <small>Permohonan selesai</small>

                </div>

            </article>

        </section>

        {{-- TABEL --}}
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
                                        <a href="{{ route('adminpermohonan.detail_permohonan') }}"
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

                                        <a href="{{ route('adminpermohonan.detail_permohonan') }}"
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

                                        <a href="{{ route('adminpermohonan.detail_permohonan') }}"
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('permohonanSearch');
    const table = document.getElementById('permohonanTable');

    if (!searchInput || !table) return;

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        table.querySelectorAll('tbody tr').forEach(function (row) {

            row.style.display = row.textContent.toLowerCase().includes(keyword)
                ? ''
                : 'none';

        });

    });

});
</script>
@endpush