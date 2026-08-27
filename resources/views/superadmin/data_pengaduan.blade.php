@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')

    <section class="sa-dashboard" id="superAdminDashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- =========================================================
            | ALERT SUCCESS
            ========================================================== --}}

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show mt-3">

                    <i class="bi bi-check-circle-fill"></i>

                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>

            @endif


            {{-- =========================================================
            | ALERT ERROR
            ========================================================== --}}

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show mt-3">

                    <i class="bi bi-exclamation-triangle-fill"></i>

                    {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>

                </div>

            @endif



            {{-- =========================================================
            | HEADER
            ========================================================== --}}

            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar" id="toggleSidebar">

                        <i class="bi bi-list"></i>

                    </button>


                    <div class="sa-page-heading">

                        <h1>
                            Data Pengaduan
                        </h1>

                        <p>
                            Kelola dan tindak lanjut seluruh pengaduan masyarakat.
                        </p>

                    </div>

                </div>


                <div class="sa-profile">

                    <div class="sa-profile-avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>


                    <div class="sa-profile-info">

                        <strong>
                            {{ auth()->user()->name ?? 'Admin BNNK' }}
                        </strong>

                        <small>
                            Administrator
                        </small>

                    </div>

                </div>

            </header>



            {{-- =========================================================
            | FILTER PENGADUAN
            ========================================================== --}}

            <section class="sa-panel mt-4">

                <div class="sa-panel-header">

                    <div>

                        <h3>
                            Filter Pengaduan
                        </h3>

                        <p>
                            Cari berdasarkan kode, judul, kategori,
                            kecamatan maupun status.
                        </p>

                    </div>

                </div>


                <div class="p-4">

                    <form action="{{ route('superadmin.data_pengaduan') }}" method="GET">

                        <div class="row g-3">


                            {{-- =================================================
                            | PENCARIAN KODE / JUDUL
                            ================================================== --}}

                            <div class="col-lg-6">

                                <div class="sa-search-box w-100">

                                    <i class="bi bi-search"></i>

                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari Kode atau Judul Aduan">

                                </div>

                            </div>



                            {{-- =================================================
                            | FILTER KATEGORI
                            ================================================== --}}

                            <div class="col-lg-6">

                                <select name="topik_aduan" class="form-select">

                                    <option value="">
                                        Semua Topik Aduan
                                    </option>

                                    <option value="Penyalahgunaan Narkotika" {{ request('topik_aduan') == 'Penyalahgunaan Narkotika' ? 'selected' : '' }}>
                                        Penyalahgunaan Narkotika
                                    </option>

                                    <option value="Peredaran Gelap Narkotika" {{ request('topik_aduan') == 'Peredaran Gelap Narkotika' ? 'selected' : '' }}>
                                        Peredaran Gelap Narkotika
                                    </option>

                                    <option value="Pelanggaran Internal" {{ request('topik_aduan') == 'Pelanggaran Internal' ? 'selected' : '' }}>
                                        Pelanggaran Internal
                                    </option>

                                </select>

                            </div>

                            {{-- =================================================
                            | FILTER KECAMATAN
                            ================================================== --}}

                            <div class="col-lg-6">

                            <select name="kecamatan" class="form-select">

    <option value="">
        Semua Kecamatan
    </option>

    @foreach($kecamatans as $kecamatan)

        <option
            value="{{ $kecamatan->id_kecamatan }}"
            {{ request('kecamatan') == $kecamatan->id_kecamatan ? 'selected' : '' }}
        >
            {{ $kecamatan->nama_kecamatan }}
        </option>

    @endforeach

</select>

                            </div>



                            {{-- =================================================
                            | FILTER STATUS
                            ================================================== --}}

                            <div class="col-lg-6">

                                <select name="status" class="form-select">

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>

                                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>

                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>

                                </select>

                            </div>



                            {{-- =================================================
                            | BUTTON
                            ================================================== --}}

                            <div class="col-12">

                                <div class="d-flex gap-2">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="bi bi-search"></i>

                                        Cari

                                    </button>


                                    <a href="{{ route('superadmin.data_pengaduan') }}" class="btn btn-secondary">

                                        <i class="bi bi-arrow-clockwise"></i>

                                        Reset

                                    </a>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </section>



            {{-- =========================================================
            | TABEL PENGADUAN
            ========================================================== --}}

            <section class="sa-panel mt-4">

                {{-- HEADER --}}
                <div class="sa-panel-header">

                    <div>
                        <h3>Daftar Pengaduan</h3>

                        <p>
                            Data pengaduan masyarakat yang masuk ke sistem.
                        </p>
                    </div>

                </div>


                {{-- TABEL --}}
                <div class="sa-table-responsive">

                    <table class="sa-table">

                        <thead>
                            <tr>

                                <th>Kode Aduan</th>

                                <th>Judul Aduan</th>

                                <th>Kategori</th>

                                <th>Kecamatan</th>

                                <th>Tanggal</th>

                                <th>Status</th>

                                <th class="sa-action-column">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <tbody>

                            @forelse($pengaduans as $pengaduan)

                                                    <tr>

                                                        {{-- KODE ADUAN --}}
                                                        <td>
                                                            <strong>
                                                                {{ $pengaduan->kode_aduan }}
                                                            </strong>
                                                        </td>


                                                        {{-- JUDUL ADUAN --}}
                                                        <td>
                                                            {{ $pengaduan->judul_aduan }}
                                                        </td>


                                                        {{-- TOPIK / KATEGORI --}}
                                                        <td>
                                                            {{ $pengaduan->topik_aduan }}
                                                        </td>


                                                        {{-- KECAMATAN --}}
                                                        <td>
                                                            {{ $pengaduan->kecamatan->nama_kecamatan ?? '-' }}
                                                        </td>


                                                        {{-- TANGGAL --}}
                                                        <td>

                                                            @if($pengaduan->created_at)

                                                                {{ $pengaduan->created_at->format('d/m/Y') }}

                                                            @else

                                                                -

                                                            @endif

                                                        </td>


                                                        {{-- STATUS --}}
                                                        <td>

                                                            @if($pengaduan->status === 'Menunggu')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#0d6efd"></span>

                                                                    Menunggu

                                                                </span>


                                                            @elseif($pengaduan->status === 'Diproses')

                                                                <span class="sa-status-badge">

                                                                    <span style="background:#fd7e14"></span>

                                                                    Diproses

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


                                                        {{-- AKSI --}}
                                                        <td>

                                                            <div class="sa-action-buttons">

                                                                {{-- DETAIL --}}
                                                          <a
    href="{{ route('superadmin.detail_pengaduan', $pengaduan->id) }}"
    class="sa-action-button sa-key-button"
    title="Lihat Detail"
>
     <i class="bi bi-pencil-square"></i>
</a>

                                                                {{-- HAPUS --}}
                                                                <form action="{{ route(
                                    'superadmin.delete_pengaduan',
                                    $pengaduan->id
                                ) }}" method="POST" style="display:inline" onsubmit="return confirm(
                                                                    'Yakin ingin menghapus data pengaduan ini?'
                                                                )">

                                                                    @csrf

                                                                    @method('DELETE')


                                                                    <button type="submit" class="sa-action-button sa-delete-button" title="Hapus">

                                                                        <i class="bi bi-trash-fill"></i>

                                                                    </button>

                                                                </form>

                                                            </div>

                                                        </td>

                                                    </tr>


                            @empty

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


                {{-- FOOTER / PAGINATION --}}
                <div class="sa-table-footer">

                    <span>

                        Menampilkan

                        {{ $pengaduans->firstItem() ?? 0 }}

                        -

                        {{ $pengaduans->lastItem() ?? 0 }}

                        dari

                        {{ $pengaduans->total() }}

                        pengaduan

                    </span>


                    <div class="sa-pagination">

                        {{ $pengaduans->links() }}

                    </div>

                </div>

            </section>

        </main>

    </section>

@endsection