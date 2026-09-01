@extends('layouts.admin')

@section('title', 'Data Permohonan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar_admin_permohonan')

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
                        <strong>{{ auth()->user()->name ?? 'Admin Permohonan' }}</strong>
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

                {{-- =========================================================
                HEADER
                ========================================================== --}}
                <div class="sa-panel-header">

                    <div>

                        <h3>
                            Daftar Permohonan
                        </h3>

                        <p>
                            Seluruh data permohonan yang telah dikirim masyarakat.
                        </p>

                    </div>

                </div>


                {{-- =========================================================
                TABLE
                ========================================================== --}}
                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>

                            <tr>

                                <th>Kode Permohonan</th>

                                <th>Jenis Permohonan</th>

                                <th>Nama Pemohon / Penyelenggara</th>

                                <th>Tanggal Kegiatan</th>

                                <th>Waktu</th>

                                <th>Tempat</th>

                                <th>Penanggung Jawab</th>

                                <th>Jumlah Peserta</th>

                                <th>Status</th>

                                <th class="sa-action-column">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($permohonans as $permohonan)

                                                    <tr>


                                                        {{-- =================================================
                                                        KODE PERMOHONAN
                                                        ================================================== --}}

                                                        <td>

                                                            <strong>

                                                                {{ $permohonan->kode_permohonan ?? '-' }}

                                                            </strong>

                                                        </td>



                                                        {{-- =================================================
                                                        JENIS PERMOHONAN
                                                        ================================================== --}}

                                                        <td>

                                                            {{ $permohonan->jenis_permohonan ?? '-' }}

                                                        </td>



                                                        {{-- =================================================
                                                        NAMA PEMOHON / PENYELENGGARA
                                                        ================================================== --}}

                                                        <td>

                                                            @if($permohonan->jenis_permohonan === 'Sosialisasi')

                                                                {{ $permohonan->nama_penyelenggara ?? '-' }}

                                                            @else

                                                                {{ $permohonan->nama_pemohon ?? '-' }}

                                                            @endif

                                                        </td>



                                                        {{-- =================================================
                                                        TANGGAL KEGIATAN
                                                        ================================================== --}}

                                                        <td>

                                                            @if($permohonan->tanggal_kegiatan)

                                                                                    {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)
                                                                ->translatedFormat('d F Y') }}

                                                            @else

                                                                -

                                                            @endif

                                                        </td>



                                                        {{-- =================================================
                                                        WAKTU KEGIATAN
                                                        ================================================== --}}

                                                        <td>

                                                            @if($permohonan->waktu_kegiatan)

                                                                                    {{ \Carbon\Carbon::parse($permohonan->waktu_kegiatan)
                                                                ->format('H:i') }}

                                                                                    WIB

                                                            @else

                                                                -

                                                            @endif

                                                        </td>



                                                        {{-- =================================================
                                                        TEMPAT
                                                        ================================================== --}}

                                                        <td>

                                                            {{ $permohonan->tempat ?? '-' }}

                                                        </td>



                                                        {{-- =================================================
                                                        PENANGGUNG JAWAB
                                                        ================================================== --}}

                                                        <td>

                                                            {{ $permohonan->penanggung_jawab ?? '-' }}

                                                        </td>



                                                        {{-- =================================================
                                                        JUMLAH PESERTA
                                                        ================================================== --}}

                                                        <td>

                                                            @if($permohonan->jumlah_peserta !== null)

                                                                {{ number_format($permohonan->jumlah_peserta, 0, ',', '.') }}

                                                                orang

                                                            @else

                                                                -

                                                            @endif

                                                        </td>




                                                        {{-- =================================================
                                                        STATUS
                                                        ================================================== --}}

                                                        <td>

                                                            @php

                                                                $status = $permohonan->status ?? '-';

                                                                $warna = match ($status) {

                                                                    'Diajukan',
                                                                    'Menunggu',
                                                                    'Menunggu Verifikasi'
                                                                    => '#6c757d',

                                                                    'Diverifikasi'
                                                                    => '#0d6efd',

                                                                    'Diproses',
                                                                    'Diproses Lapangan'
                                                                    => '#fd7e14',

                                                                    'Selesai'
                                                                    => '#198754',

                                                                    'Ditolak'
                                                                    => '#dc3545',

                                                                    default
                                                                    => '#6c757d',

                                                                };

                                                            @endphp


                                                            <span class="sa-status-badge">

                                                                <span style="background: {{ $warna }}"></span>

                                                                {{ $status }}

                                                            </span>

                                                        </td>





                                                        {{-- =================================================
                                                        AKSI
                                                        ================================================== --}}

                                                        <td>

                                                            <div class="sa-action-buttons">


                                                                {{-- DETAIL / EDIT --}}

                                                                <a href="{{ route(
                                    'adminpermohonan.detail_permohonan',
                                    ['id' => $permohonan->id]
                                ) }}" class="sa-action-button sa-key-button" title="Detail Permohonan">

                                                                    <i class="bi bi-pencil-square"></i>

                                                                </a>



                                                                {{-- HAPUS --}}

                                                                <form action="{{ route(
                                    'adminpermohonan.delete_permohonan',
                                    ['id' => $permohonan->id]
                                ) }}" method="POST" style="display:inline;">

                                                                    @csrf

                                                                    @method('DELETE')


                                                                    <button type="submit" class="sa-action-button sa-delete-button"
                                                                        title="Hapus Permohonan"
                                                                        onclick="return confirm(
                                                                                                                                                                                                                                                'Yakin ingin menghapus data permohonan ini?'
                                                                                                                                                                                                                                            )">

                                                                        <i class="bi bi-trash-fill"></i>

                                                                    </button>

                                                                </form>


                                                            </div>

                                                        </td>


                                                    </tr>


                            @empty


                                <tr>

                                    <td colspan="10" class="text-center text-muted py-4">

                                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                        Belum ada data permohonan.

                                    </td>

                                </tr>


                            @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- =========================================================
                FOOTER
                ========================================================== --}}

                <div class="sa-table-footer">

                    <span>

                        Menampilkan
                        {{ $permohonans->count() }}
                        dari
                        {{ $permohonans->total() ?? $permohonans->count() }}
                        permohonan

                    </span>


                    @if(method_exists($permohonans, 'hasPages') && $permohonans->hasPages())

                        <div class="sa-pagination">

                            {{-- PREVIOUS --}}

                            @if($permohonans->onFirstPage())

                                <button disabled>

                                    <i class="bi bi-chevron-left"></i>

                                </button>

                            @else

                                <a href="{{ $permohonans->previousPageUrl() }}" class="sa-pagination-link">

                                    <i class="bi bi-chevron-left"></i>

                                </a>

                            @endif



                            {{-- CURRENT PAGE --}}

                            <button class="active">

                                {{ $permohonans->currentPage() }}

                            </button>



                            {{-- NEXT --}}

                            @if($permohonans->hasMorePages())

                                <a href="{{ $permohonans->nextPageUrl() }}" class="sa-pagination-link">

                                    <i class="bi bi-chevron-right"></i>

                                </a>

                            @else

                                <button disabled>

                                    <i class="bi bi-chevron-right"></i>

                                </button>

                            @endif

                        </div>

                    @endif

                </div>

            </section>

        </main>

    </section>

@endsection