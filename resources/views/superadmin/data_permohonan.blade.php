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

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- HEADER --}}
        <header class="sa-topbar">

            <div class="sa-topbar-left">

                <button class="sa-toggle-sidebar"
                        id="toggleSidebar">
                    <i class="bi bi-list"></i>
                </button>

                <div class="sa-page-heading">
                    <h1>Data Permohonan</h1>

                    <p>
                        Kelola seluruh permohonan layanan masyarakat
                        BNNK Tulungagung.
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

                    <small>
                        Administrator Sistem
                    </small>
                </div>

            </div>

        </header>

        {{-- FILTER --}}
        <section class="sa-panel mt-4">

            <div class="sa-panel-header">

                <div>

                    <h3>
                        Filter Permohonan
                    </h3>

                    <p>
                        Cari berdasarkan kode permohonan,
                        nama penyelenggara,
                        jenis permohonan,
                        tanggal kegiatan,
                        dan status.
                    </p>

                </div>

            </div>

            <div class="p-4">

                <form action="{{ route('superadmin.data_permohonan') }}"
                      method="GET">

                    <div class="row g-3">

                        {{-- SEARCH --}}
                        <div class="col-lg-6">

                            <div class="sa-search-box w-100">

                                <i class="bi bi-search"></i>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari kode atau nama penyelenggara">

                            </div>

                        </div>

                        {{-- JENIS PERMOHONAN --}}
                        <div class="col-lg-6">

                            <select name="jenis_permohonan"
                                    class="form-select">

                                <option value="">
                                    Semua Jenis Permohonan
                                </option>

                                @foreach($jenisPermohonan as $jenis)

                                    <option
                                        value="{{ $jenis }}"
                                        {{ request('jenis_permohonan') == $jenis ? 'selected' : '' }}
                                    >
                                        {{ $jenis }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- TANGGAL KEGIATAN --}}
                        <div class="col-lg-6">

                            <input
                                type="date"
                                name="tanggal_kegiatan"
                                class="form-control"
                                value="{{ request('tanggal_kegiatan') }}">

                        </div>

                        {{-- STATUS --}}
                        <div class="col-lg-6">

                            <select name="status"
                                    class="form-select">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="Menunggu"
                                    {{ request('status') == 'Menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="Diproses"
                                    {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>

                                <option value="Selesai"
                                    {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="Ditolak"
                                    {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>

                            </select>

                        </div>

                        {{-- BUTTON --}}
                        <div class="col-12">

                            <div class="d-flex gap-2">

                                <button type="submit"
                                        class="btn btn-primary">

                                    <i class="bi bi-search"></i>
                                    Cari

                                </button>

                                <a href="{{ route('superadmin.data_permohonan') }}"
                                   class="btn btn-secondary">

                                    <i class="bi bi-arrow-clockwise"></i>
                                    Reset

                                </a>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

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

                                    {{-- TOKEN --}}
                                    <td>
                                        <strong>
                                            {{ $permohonan->kode_permohonan ?? '-' }}
                                        </strong>
                                    </td>


                                    {{-- JENIS PERMOHONAN --}}
                                    <td>
                                        {{ $permohonan->jenis_permohonan ?? '-' }}
                                    </td>


                                    {{-- NAMA PEMOHON --}}
                                    <td>
                                        {{ $permohonan->nama_penyelenggara ?? '-' }}
                                    </td>


                                    {{-- KECAMATAN / TEMPAT --}}
                                    <td>
                                        {{ $permohonan->tempat ?? '-' }}
                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        @if($permohonan->created_at)

                                            {{ \Carbon\Carbon::parse($permohonan->created_at)->translatedFormat('d F Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @php

                                            $status = $permohonan->status ?? '-';

                                            $warna = match ($status) {

                                                'Menunggu',
                                                'Menunggu Verifikasi',
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


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="sa-action-buttons">

                                            {{-- EDIT --}}
                                            <a href="{{ route(
                                                'superadmin.detail_permohonan',
                                                $permohonan->id
                                            ) }}"
                                            class="sa-action-button sa-key-button"
                                            title="Edit Permohonan">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form
                                                action="{{ route(
                                                    'superadmin.delete_permohonan',
                                                    $permohonan->id
                                                ) }}"
                                                method="POST"
                                                style="display:inline;"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="sa-action-button sa-delete-button"
                                                    title="Hapus Permohonan"
                                                    onclick="return confirm('Yakin ingin menghapus data permohonan ini?')"
                                                >

                                                    <i class="bi bi-trash-fill"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center text-muted py-4">

                                        Belum ada data permohonan.

                                    </td>

                                </tr>

                            @endforelse

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