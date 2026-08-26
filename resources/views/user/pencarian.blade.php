@extends('layouts.app')

@section('title', 'Pencarian Pelayanan')

@section('content')

    <section class="tracking-page">

        <div class="container">

            {{-- =====================================================
            HERO
            ====================================================== --}}

            <div class="tracking-hero">

                <div class="tracking-hero-content">

                    <span class="tracking-badge">
                        <i class="bi bi-search"></i>
                        LAYANAN PENCARIAN
                    </span>

                    <h1>
                        Cari Status Pelayanan Anda
                    </h1>

                    <p>
                        Masukkan kode aduan atau kode permohonan
                        untuk melihat status dan perkembangan pelayanan
                        secara langsung.
                    </p>

                </div>

                <div class="tracking-hero-icon">

                    <i class="bi bi-search"></i>

                </div>

            </div>


            {{-- =====================================================
            SEARCH BERDASARKAN KODE
            ====================================================== --}}

            <div class="tracking-search-card">

                <div class="tracking-search-header">

                    <div class="tracking-search-icon">

                        <i class="bi bi-upc-scan"></i>

                    </div>

                    <div>

                        <h3>
                            Cari Berdasarkan Kode
                        </h3>

                        <p>
                            Gunakan kode yang Anda terima setelah
                            mengirimkan aduan atau permohonan.
                        </p>

                    </div>

                </div>


                {{-- ERROR SESSION --}}

                @if(session('error'))

                    <div class="tracking-alert tracking-alert-danger">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        <div>
                            {{ session('error') }}
                        </div>

                    </div>

                @endif


                {{-- SUCCESS SESSION --}}

                @if(session('success'))

                    <div class="tracking-alert tracking-alert-success">

                        <i class="bi bi-check-circle-fill"></i>

                        <div>
                            {{ session('success') }}
                        </div>

                    </div>

                @endif


                {{-- VALIDATION ERROR --}}

                @error('kode')

                    <div class="tracking-alert tracking-alert-danger">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        <div>
                            {{ $message }}
                        </div>

                    </div>

                @enderror


                {{-- FORM PENCARIAN KODE --}}

                <form action="{{ route('tracking.search') }}" method="GET" class="tracking-search-form">

                    <div class="tracking-input-group">

                        <div class="tracking-input-icon">

                            <i class="bi bi-upc"></i>

                        </div>

                        <input type="text" name="kode" value="{{ request('kode') }}"
                            placeholder="Masukkan kode aduan atau permohonan" autocomplete="off" required>

                    </div>


                    <button type="submit" class="tracking-search-button">

                        <i class="bi bi-search"></i>

                        Cari Sekarang

                    </button>

                </form>


                <div class="tracking-help">

                    <i class="bi bi-info-circle"></i>

                    <span>

                        Masukkan kode unik yang Anda terima
                        setelah mengirimkan pengaduan atau permohonan.

                    </span>

                </div>

            </div>



            {{-- =====================================================
            PILIHAN LAYANAN
            ====================================================== --}}

            <div class="tracking-service-section">

                <div class="tracking-section-title">

                    <span>
                        PILIHAN LAYANAN
                    </span>

                    <h2>
                        Pelayanan yang Ingin Anda Cari
                    </h2>

                    <p>
                        Anda dapat mencari pengaduan atau permohonan
                        berdasarkan informasi pelayanan.
                    </p>

                </div>


                {{-- =================================================
                GRID 2 KOLOM
                ================================================== --}}

                <div class="row g-4">


                    {{-- =================================================
                    KOLOM PENGADUAN
                    ================================================== --}}

                    <div class="col-md-6">

                        <div class="tracking-service-card">

                            {{-- HEADER --}}

                            <div class="tracking-service-header">

                                <div class="tracking-service-icon pengaduan">

                                    <i class="bi bi-megaphone-fill"></i>

                                </div>

                                <div>

                                    <h4>
                                        Pengaduan
                                    </h4>

                                    <p>
                                        Cari laporan atau pengaduan
                                        berdasarkan judul/topik aduan.
                                    </p>

                                </div>

                            </div>


                            {{-- SEARCH PENGADUAN --}}

                            <div class="search-permohonan-box">

                                <form action="{{ route('pencarian') }}" method="GET">

                                    <div class="search-permohonan-wrapper">

                                        <div class="search-permohonan-input-wrapper">

                                            <i class="bi bi-search"></i>

                                            <input type="text" name="topik" value="{{ request('topik') }}"
                                                placeholder="Cari berdasarkan topik aduan..." autocomplete="off">

                                        </div>


                                        <button type="submit" class="btn-search-permohonan">

                                            <i class="bi bi-search"></i>

                                            Cari

                                        </button>

                                    </div>

                                </form>

                            </div>


                            {{-- HASIL PENGADUAN --}}

                            <div class="tracking-service-list">

                                <div class="tracking-list-title">

                                    <span>

                                        @if(request()->filled('topik'))

                                            Hasil Pencarian Pengaduan

                                        @else

                                            Pengaduan Terbaru

                                        @endif

                                    </span>

                                </div>


                                {{-- SCROLL KHUSUS PENGADUAN --}}

                                <div class="tracking-list-scroll">

                                    @forelse($aduanTerbaru as $item)

                                                                    <div class="tracking-service-item">


                                                                        {{-- STATUS --}}

                                                                        <div class="tracking-item-top">

                                                                            <span
                                                                                class="tracking-status
                                                                                                                                                                                                    @if($item->status == 'Menunggu')
                                                                                                                                                                                                        menunggu
                                                                                                                                                                                                    @elseif($item->status == 'Diproses')
                                                                                                                                                                                                        proses
                                                                                                                                                                                                    @elseif($item->status == 'Selesai')
                                                                                                                                                                                                        selesai
                                                                                                                                                                                                    @elseif($item->status == 'Ditolak')
                                                                                                                                                                                                        ditolak
                                                                                                                                                                                                    @else
                                                                                                                                                                                                        verifikasi
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                ">

                                                                                {{ $item->status }}

                                                                            </span>

                                                                        </div>


                                                                        {{-- JUDUL --}}

                                                                        <h6>

                                                                            {{ \Illuminate\Support\Str::limit(
                                            $item->judul_aduan ?? '-',
                                            45
                                        ) }}

                                                                        </h6>


                                                                        {{-- INFORMASI --}}

                                                                        <div class="tracking-item-info">

                                                                            <span>

                                                                                <i class="bi bi-geo-alt-fill"></i>

                                                                                {{ $item->kecamatan->nama_kecamatan ?? '-' }}

                                                                            </span>


                                                                            <span>

                                                                                <i class="bi bi-calendar-event-fill"></i>

                                                                                {{ $item->created_at
                                            ? $item->created_at->translatedFormat('d F Y')
                                            : '-'
                                                                                                                                                                                                    }}

                                                                            </span>

                                                                        </div>


                                                                        {{-- BUTTON --}}

                                                                        <a href="{{ route(
                                            'pengaduan.tracking.public',
                                            ['kode' => $item->kode_aduan]
                                        ) }}" class="tracking-item-button">

                                                                            <i class="bi bi-eye-fill"></i>

                                                                            Lihat Tracking

                                                                        </a>

                                                                    </div>

                                    @empty

                                        <div class="tracking-empty">

                                            <i class="bi bi-search"></i>

                                            @if(request()->filled('topik'))

                                                <p>

                                                    Pengaduan dengan topik
                                                    "<strong>{{ request('topik') }}</strong>"
                                                    tidak ditemukan.

                                                </p>

                                            @else

                                                <p>
                                                    Belum ada pengaduan.
                                                </p>

                                            @endif

                                        </div>

                                    @endforelse

                                </div>

                            </div>


                            {{-- CLEAR SEARCH --}}

                            @if(request()->filled('topik'))

                                <div class="tracking-clear-search">

                                    <a href="{{ route('pencarian') }}" class="btn-clear-search">

                                        <i class="bi bi-arrow-counterclockwise"></i>

                                        Tampilkan Semua Pengaduan

                                    </a>

                                </div>

                            @endif

                        </div>

                    </div>



                    {{-- =================================================
                    KOLOM PERMOHONAN
                    ================================================== --}}

                    <div class="col-md-6">

                        <div class="tracking-service-card">

                            {{-- HEADER --}}

                            <div class="tracking-service-header">

                                <div class="tracking-service-icon permohonan">

                                    <i class="bi bi-file-earmark-text-fill"></i>

                                </div>

                                <div>

                                    <h4>
                                        Permohonan
                                    </h4>

                                    <p>
                                        Cari permohonan
                                        berdasarkan jenis permohonan.
                                    </p>

                                </div>

                            </div>


                            {{-- SEARCH PERMOHONAN --}}

                            <div class="search-permohonan-box">

                                <form action="{{ route('pencarian') }}" method="GET">

                                    <div class="search-permohonan-wrapper">

                                        <div class="search-permohonan-input-wrapper">

                                            <i class="bi bi-search"></i>

                                            <input type="text" name="jenis_permohonan"
                                                value="{{ request('jenis_permohonan') }}"
                                                placeholder="Cari berdasarkan jenis permohonan..." autocomplete="off">

                                        </div>


                                        <button type="submit" class="btn-search-permohonan">

                                            <i class="bi bi-search"></i>

                                            Cari

                                        </button>

                                    </div>

                                </form>

                            </div>


                            {{-- HASIL PERMOHONAN --}}

                            <div class="tracking-service-list">

                                <div class="tracking-list-title">

                                    <span>

                                        @if(request()->filled('jenis_permohonan'))

                                            Hasil Pencarian Permohonan

                                        @else

                                            Permohonan Terbaru

                                        @endif

                                    </span>

                                </div>


                                {{-- SCROLL KHUSUS PERMOHONAN --}}

                                <div class="tracking-list-scroll">

                                    @forelse($permohonanTerbaru as $item)

                                                                    <div class="tracking-service-item">


                                                                        {{-- STATUS --}}

                                                                        <div class="tracking-item-top">

                                                                            <span
                                                                                class="tracking-status
                                                                                                                                                                                                    @if($item->status == 'Diajukan')
                                                                                                                                                                                                        menunggu
                                                                                                                                                                                                    @elseif($item->status == 'Diverifikasi')
                                                                                                                                                                                                        verifikasi
                                                                                                                                                                                                    @elseif($item->status == 'Diproses')
                                                                                                                                                                                                        proses
                                                                                                                                                                                                    @elseif($item->status == 'Selesai')
                                                                                                                                                                                                        selesai
                                                                                                                                                                                                    @elseif($item->status == 'Ditolak')
                                                                                                                                                                                                        ditolak
                                                                                                                                                                                                    @else
                                                                                                                                                                                                        verifikasi
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                ">

                                                                                {{ $item->status }}

                                                                            </span>

                                                                        </div>


                                                                        {{-- JENIS PERMOHONAN --}}

                                                                        <h6>

                                                                            {{ $item->jenis_permohonan ?? '-' }}

                                                                        </h6>


                                                                        {{-- INFORMASI --}}

                                                                        <div class="tracking-item-info">

                                                                            <span>

                                                                                <i class="bi bi-calendar-event-fill"></i>

                                                                                {{ $item->created_at
                                            ? $item->created_at->translatedFormat('d F Y')
                                            : '-'
                                                                                                                                                                                                    }}

                                                                            </span>


                                                                            <span>

                                                                                <i class="bi bi-person-fill"></i>

                                                                                {{ \Illuminate\Support\Str::limit(
                                            $item->nama_penyelenggara
                                            ?? $item->nama_pemohon
                                            ?? '-',
                                            25
                                        ) }}

                                                                            </span>

                                                                        </div>


                                                                        {{-- JENIS REHABILITASI --}}

                                                                        @if(
                                                                                $item->jenis_permohonan === 'Rehabilitasi'
                                                                                && !empty($item->jenis_rehabilitasi)
                                                                            )

                                                                            <div class="tracking-item-extra">

                                                                                <i class="bi bi-heart-pulse-fill"></i>

                                                                                {{ $item->jenis_rehabilitasi }}

                                                                            </div>

                                                                        @endif


                                                                        {{-- BUTTON --}}

                                                                        <a href="{{ route(
                                            'permohonan.tracking.public',
                                            ['kode' => $item->kode_permohonan]
                                        ) }}" class="tracking-item-button">

                                                                            <i class="bi bi-eye-fill"></i>

                                                                            Lihat Tracking

                                                                        </a>

                                                                    </div>

                                    @empty

                                        <div class="tracking-empty">

                                            <i class="bi bi-search"></i>

                                            @if(request()->filled('jenis_permohonan'))

                                                <p>

                                                    Permohonan dengan jenis
                                                    "<strong>{{ request('jenis_permohonan') }}</strong>"
                                                    tidak ditemukan.

                                                </p>

                                            @else

                                                <p>
                                                    Belum ada permohonan.
                                                </p>

                                            @endif

                                        </div>

                                    @endforelse

                                </div>

                            </div>


                            {{-- CLEAR SEARCH --}}

                            @if(request()->filled('jenis_permohonan'))

                                <div class="tracking-clear-search">

                                    <a href="{{ route('pencarian') }}" class="btn-clear-search">

                                        <i class="bi bi-arrow-counterclockwise"></i>

                                        Tampilkan Semua Permohonan

                                    </a>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>



            {{-- =====================================================
            INFORMATION
            ====================================================== --}}

            <div class="tracking-information">

                <div class="tracking-information-icon">

                    <i class="bi bi-shield-check"></i>

                </div>

                <div>

                    <h4>
                        Data Anda Aman
                    </h4>

                    <p>
                        Pencarian dilakukan menggunakan kode pelayanan
                        atau informasi pelayanan yang tersedia.
                        Jangan membagikan kode pelayanan Anda kepada
                        orang lain.
                    </p>

                </div>

            </div>

        </div>

    </section>

@endsection