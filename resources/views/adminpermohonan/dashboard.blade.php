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

                    <button type="button" class="sa-toggle-sidebar" id="toggleSidebar">

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


            {{-- statisik --}}

            <section class="sa-statistics">

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-blue">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>

                    <div class="sa-stat-content">
                        <span>Total Permohonan</span>
                        <h2>{{ $totalPermohonan }}</h2>
                        <small>Seluruh permohonan masyarakat</small>
                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-yellow">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <div class="sa-stat-content">
                        <span>Menunggu Verifikasi</span>
                        <h2>{{ $diverifikasi }}</h2>
                        <small>Belum diverifikasi</small>
                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-blue">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <div class="sa-stat-content">
                        <span>Sedang Diproses</span>
                        <h2>{{ $diproses }}</h2>
                        <small>Sedang ditindaklanjuti</small>
                    </div>

                </article>

                <article class="sa-stat-card">

                    <div class="sa-stat-icon sa-stat-green">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <div class="sa-stat-content">
                        <span>Selesai</span>
                        <h2>{{ $selesai }}</h2>
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

                            @forelse($permohonans as $permohonan)

                                <tr>

                                    <td>{{ $permohonan->kode_permohonan }}</td>

                                    <td>{{ $permohonan->jenis_permohonan }}</td>

                                    <td>{{ $permohonan->nama_penyelenggara }}</td>

                                    <td>{{ $permohonan->tempat }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y') }}
                                    </td>

                                    <td>

                                        @php

                                            $warna = '#ffc107';

                                            if ($permohonan->status == 'Diproses') {
                                                $warna = '#0d6efd';
                                            }

                                            if ($permohonan->status == 'Selesai') {
                                                $warna = '#198754';
                                            }

                                            if ($permohonan->status == 'Ditolak') {
                                                $warna = '#dc3545';
                                            }

                                        @endphp

                                        <span class="sa-status-badge">

                                            <span style="background:{{ $warna }}"></span>

                                            {{ $permohonan->status }}

                                        </span>

                                    </td>

                                    <td>

                                        <div class="sa-action-buttons">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('adminpermohonan.detail_permohonan', $permohonan->id) }}"
                                                class="sa-action-button sa-key-button" title="Detail Permohonan">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            {{-- HAPUS --}}
                                            <form action="{{ route('adminpermohonan.delete_permohonan', $permohonan->id) }}"
                                                method="POST" style="display:inline;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="sa-action-button sa-delete-button"
                                                    onclick="return confirm('Yakin ingin menghapus data permohonan ini?')">

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-4">

                                        Tidak ada data permohonan.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="sa-table-footer">

                    <span>
                        Menampilkan
                        {{ $permohonans->firstItem() ?? 0 }}
                        -
                        {{ $permohonans->lastItem() ?? 0 }}
                        dari
                        {{ $permohonans->total() }}
                        data
                    </span>

                    <div class="sa-pagination">
                        {{ $permohonans->links() }}
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