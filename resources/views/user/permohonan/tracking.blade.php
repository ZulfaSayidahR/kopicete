@extends('layouts.app')

@section('title', 'Detail Tracking Permohonan')

@section('content')

    <section class="tracking-page">

        <div class="container">

            {{-- HEADER --}}
            <div class="tracking-header">

                <div class="logo-box">

                    <div>

                        <h4>BNNK Tulungagung</h4>

                        <small class="text-white">
                            Sistem Pelacakan Permohonan Masyarakat
                        </small>

                    </div>

                </div>

            </div>


            {{-- BODY --}}
            <div class="tracking-body">

                <div class="tracking-grid">


                    {{-- ==========================================
                    KOLOM KIRI
                    =========================================== --}}

                    <div class="tracking-left">


                        {{-- INFORMASI PERMOHONAN --}}
                        <div class="tracking-card mb-4">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h5 class="mb-0">

                                    Informasi Permohonan

                                </h5>


                                {{-- ==========================================
                                STATUS PERMOHONAN
                                ========================================== --}}

                                @php

                                    $status = trim($permohonan->status ?? 'Diajukan');

                                    $warnaStatus = match ($status) {

                                        'Diajukan',
                                        'Menunggu',
                                        'Menunggu Verifikasi'
                                        => 'bg-secondary',

                                        'Diverifikasi'
                                        => 'bg-primary',

                                        'Diproses'
                                        => 'bg-warning text-dark',

                                        'Selesai'
                                        => 'bg-success',

                                        'Ditolak'
                                        => 'bg-danger',

                                        default
                                        => 'bg-secondary',

                                    };

                                @endphp


                                <span class="badge {{ $warnaStatus }}">

                                    {{ $status }}

                                </span>
                            </div>


                            <div class="info-grid">

                                {{-- =====================================================
                                KODE PERMOHONAN
                                ====================================================== --}}
                                <div>

                                    <strong>
                                        <i class="bi bi-upc-scan"></i>
                                        Kode Permohonan
                                    </strong>

                                    <p>

                                        @if($permohonan->kode_permohonan)

                                            {{ substr($permohonan->kode_permohonan, 0, 4) }}
                                            ******
                                            {{ substr($permohonan->kode_permohonan, -3) }}

                                        @else

                                            -

                                        @endif

                                    </p>

                                </div>


                                {{-- =====================================================
                                JENIS PERMOHONAN
                                ====================================================== --}}
                                <div>

                                    <strong>
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                        Jenis Permohonan
                                    </strong>

                                    <p>
                                        {{ $permohonan->jenis_permohonan ?? '-' }}
                                    </p>

                                </div>


                                {{-- =====================================================
                                KHUSUS REHABILITASI
                                ====================================================== --}}
                                @if(
                                        strtolower(trim($permohonan->jenis_permohonan ?? '')) === 'rehabilitasi'
                                        ||
                                        strtolower(trim($permohonan->jenis_permohonan ?? '')) === 'permohonan rehabilitasi'
                                    )

                                    {{-- NAMA PEMOHON --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-person-fill"></i>
                                            Nama Pemohon
                                        </strong>

                                        <p>
                                            {{ $permohonan->nama_pemohon ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- NIK --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-card-text"></i>
                                            NIK
                                        </strong>

                                        <p>
                                            {{ $permohonan->nik ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- NO WHATSAPP --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-whatsapp"></i>
                                            No. WhatsApp
                                        </strong>

                                        <p>

                                            @if($permohonan->no_hp)

                                                {{ substr($permohonan->no_hp, 0, 4) }}
                                                ******
                                                {{ substr($permohonan->no_hp, -3) }}

                                            @else

                                                -

                                            @endif

                                        </p>

                                    </div>


                                    {{-- JENIS REHABILITASI --}}
                                    <!-- <div>

                                                        <strong>
                                                            <i class="bi bi-heart-pulse-fill"></i>
                                                            Jenis Rehabilitasi
                                                        </strong>

                                                        <p>
                                                            {{ $permohonan->jenis_rehabilitasi ?? '-' }}
                                                        </p>

                                                    </div> -->


                                    {{-- ALAMAT PEMOHON --}}
                                    <div style="grid-column: 1 / -1;">

                                        <strong>
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Alamat Pemohon
                                        </strong>

                                        <p>
                                            {{ $permohonan->alamat_pemohon ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- =====================================================
                                    KHUSUS SOSIALISASI
                                    ====================================================== --}}
                                @elseif(
                                        strtolower(trim($permohonan->jenis_permohonan ?? '')) === 'sosialisasi'
                                        ||
                                        strtolower(trim($permohonan->jenis_permohonan ?? '')) === 'permohonan sosialisasi'
                                    )

                                    {{-- NAMA PENYELENGGARA --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-building-fill"></i>
                                            Nama Penyelenggara
                                        </strong>

                                        <p>
                                            {{ $permohonan->nama_penyelenggara ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- PENANGGUNG JAWAB --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-person-fill"></i>
                                            Penanggungjawab
                                        </strong>

                                        <p>
                                            {{ $permohonan->penanggung_jawab ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- NO WHATSAPP --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-whatsapp"></i>
                                            No. WhatsApp
                                        </strong>

                                        <p>

                                            @if($permohonan->no_hp)

                                                {{ substr($permohonan->no_hp, 0, 4) }}
                                                ******
                                                {{ substr($permohonan->no_hp, -3) }}

                                            @else

                                                -

                                            @endif

                                        </p>

                                    </div>


                                    {{-- JUMLAH PESERTA --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-people-fill"></i>
                                            Jumlah Peserta
                                        </strong>

                                        <p>
                                            {{ $permohonan->jumlah_peserta ?? 0 }} orang
                                        </p>

                                    </div>


                                    {{-- TANGGAL KEGIATAN --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-calendar-event-fill"></i>
                                            Tanggal Kegiatan
                                        </strong>

                                        <p>

                                            @if($permohonan->tanggal_kegiatan)

                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->translatedFormat('d F Y') }}

                                            @else

                                                -

                                            @endif

                                        </p>

                                    </div>


                                    {{-- WAKTU KEGIATAN --}}
                                    <div>

                                        <strong>
                                            <i class="bi bi-clock-fill"></i>
                                            Waktu Kegiatan
                                        </strong>

                                        <p>
                                            {{ $permohonan->waktu_kegiatan ?? '-' }}
                                        </p>

                                    </div>


                                    {{-- TEMPAT KEGIATAN --}}
                                    <div style="grid-column: 1 / -1;">

                                        <strong>
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Tempat Kegiatan
                                        </strong>

                                        <p>
                                            {{ $permohonan->tempat ?? '-' }}
                                        </p>

                                    </div>

                                @else

                                    {{-- JENIS TIDAK DIKENALI --}}
                                    <div style="grid-column: 1 / -1;">

                                        <div class="alert alert-warning mb-0">

                                            <i class="bi bi-exclamation-triangle me-2"></i>

                                            Data jenis permohonan tidak dikenali.

                                        </div>

                                    </div>

                                @endif

                            </div>

                            {{-- KETERANGAN --}}
                            <div class="kronologi">

                                <h6>

                                    <i class="bi bi-file-text-fill"></i>

                                    Keterangan

                                </h6>


                                <div class="kronologi-box">

                                    @if($permohonan->keterangan)

                                        {!! nl2br(e($permohonan->keterangan)) !!}

                                    @else

                                        <span class="text-muted">
                                            Tidak ada keterangan.
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>



                        {{-- LAMPIRAN --}}
                        <div class="tracking-card">

                            <h5>

                                <i class="bi bi-paperclip"></i>

                                Lampiran Surat Undangan

                            </h5>


                            @if($permohonan->lampiran)

                                <div class="text-center mt-3">

                                    @php

                                        $extension =
                                            strtolower(
                                                pathinfo(
                                                    $permohonan->lampiran,
                                                    PATHINFO_EXTENSION
                                                )
                                            );

                                    @endphp


                                    @if(in_array($extension, ['jpg', 'jpeg', 'png']))

                                        <img src="{{ asset('storage/' . $permohonan->lampiran) }}" class="img-fluid rounded shadow"
                                            style="max-height:350px;">

                                    @else

                                        <div class="text-center p-4">

                                            <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size:60px;">
                                            </i>

                                            <p class="mt-2">
                                                Dokumen PDF
                                            </p>

                                            <a href="{{ asset('storage/' . $permohonan->lampiran) }}" target="_blank"
                                                class="btn btn-danger">

                                                <i class="bi bi-eye-fill"></i>

                                                Lihat Lampiran

                                            </a>

                                        </div>

                                    @endif

                                </div>

                            @else

                                <div class="alert alert-light text-center mt-3">

                                    <i class="bi bi-file-earmark-x fs-2 d-block mb-2"></i>

                                    Tidak ada lampiran.

                                </div>

                            @endif

                        </div>

                    </div>



                    {{-- ==========================================
                    KOLOM KANAN
                    =========================================== --}}
                    <aside class="tracking-card status-card">

                        <h5>
                            <i class="bi bi-clock-history"></i>
                            Riwayat Status
                        </h5>

                        <div class="tracking-timeline">


                            {{-- =====================================================
                            DIAJUKAN
                            ===================================================== --}}

                            <div class="tracking-item selesai">

                                <div class="tracking-icon">
                                    <i class="bi bi-check-lg"></i>
                                </div>


                                <div class="tracking-content">

                                    <h6>Diajukan</h6>


                                    <small class="d-block">

                                        <i class="bi bi-calendar-event me-1"></i>

                                        {{ $permohonan->created_at
        ? $permohonan->created_at->translatedFormat('d F Y H:i')
        : '-' 
                                                                        }}

                                    </small>


                                </div>

                            </div>




                            {{-- =====================================================
                            DIVERIFIKASI
                            ===================================================== --}}

                            @php

                                $verifikasi =
                                    !empty($permohonan->tanggal_verifikasi);

                            @endphp


                            <div class="tracking-item 
                                                                {{ $verifikasi ? 'selesai' : '' }}">


                                <div class="tracking-icon">


                                    @if($verifikasi)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-circle"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>Diverifikasi Admin</h6>


                                    @if($verifikasi)


                                                                    <small class="d-block">

                                                                        <i class="bi bi-calendar-event me-1"></i>


                                                                        {{ \Carbon\Carbon::parse(
                                            $permohonan->tanggal_verifikasi
                                        )->translatedFormat('d F Y H:i') }}


                                                                    </small>



                                                                    <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal" data-status-detail="Diverifikasi">

                                                                        <i class="bi bi-eye-fill"></i>
                                                                        Lihat Detail

                                                                    </button>


                                    @else


                                        <small class="text-muted">

                                            Menunggu verifikasi admin.

                                        </small>


                                    @endif


                                </div>


                            </div>






                            {{-- =====================================================
                            DIPROSES
                            ===================================================== --}}

                            @php

                                $proses =
                                    !empty($permohonan->tanggal_proses);

                            @endphp



                            <div class="tracking-item
                                                                {{ $proses ? 'selesai' : '' }}">


                                <div class="tracking-icon">


                                    @if($proses)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-hourglass-split"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>Diproses BNNK</h6>


                                    @if($proses)


                                                                    <small class="d-block">


                                                                        <i class="bi bi-calendar-event me-1"></i>


                                                                        {{ \Carbon\Carbon::parse(
                                            $permohonan->tanggal_proses
                                        )->translatedFormat('d F Y H:i') }}


                                                                    </small>



                                                                    <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal" data-status-detail="Diproses">

                                                                        <i class="bi bi-eye-fill"></i>
                                                                        Lihat Detail

                                                                    </button>


                                    @else


                                        <small class="text-muted">

                                            Menunggu proses BNNK.

                                        </small>


                                    @endif


                                </div>


                            </div>







                            {{-- =====================================================
                            SELESAI
                            ===================================================== --}}


                            @php

                                $selesai =
                                    !empty($permohonan->tanggal_selesai);

                            @endphp



                            <div class="tracking-item
                                                                {{ $selesai ? 'selesai' : '' }}">



                                <div class="tracking-icon">


                                    @if($selesai)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-flag"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>Selesai</h6>



                                    @if($selesai)


                                                                    <small class="d-block">


                                                                        <i class="bi bi-calendar-event me-1"></i>


                                                                        {{ \Carbon\Carbon::parse(
                                            $permohonan->tanggal_selesai
                                        )->translatedFormat('d F Y H:i') }}


                                                                    </small>




                                                                    <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal" data-status-detail="Selesai">

                                                                        <i class="bi bi-eye-fill"></i>
                                                                        Lihat Detail

                                                                    </button>



                                    @else


                                        <small class="text-muted">

                                            Permohonan belum selesai.

                                        </small>


                                    @endif


                                </div>


                            </div>






                            {{-- =====================================================
                            DITOLAK
                            ===================================================== --}}


                            @if($permohonan->status == 'Ditolak')


                                <div class="tracking-item selesai">


                                    <div class="tracking-icon">

                                        <i class="bi bi-x-lg"></i>

                                    </div>



                                    <div class="tracking-content">


                                        <h6>Permohonan Ditolak</h6>



                                        @if($permohonan->tanggal_penolakan)


                                                                    <small class="d-block">


                                                                        <i class="bi bi-calendar-event me-1"></i>


                                                                        {{ \Carbon\Carbon::parse(
                                                $permohonan->tanggal_penolakan
                                            )->translatedFormat('d F Y H:i') }}


                                                                    </small>


                                        @endif



                                        <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                            data-bs-target="#detailPermohonanModal" data-status-detail="Ditolak">

                                            <i class="bi bi-eye-fill"></i>
                                            Lihat Detail

                                        </button>


                                    </div>


                                </div>


                            @endif


                        </div>


                        {{-- KEMBALI --}}
                        <div class="mt-4">

                            <a href="{{ route('home') }}" class="btn btn-light w-100">

                                <i class="bi bi-house-door-fill"></i>

                                Kembali ke Beranda

                            </a>

                        </div>

                    </aside>

                </div>

            </div>

        </div>

    </section>




    {{-- =====================================================
    MODAL DETAIL TINDAK LANJUT PERMOHONAN
    ===================================================== --}}

    @php

        /*
        |--------------------------------------------------------------------------
        | JENIS PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $jenisPermohonan = strtolower(
            trim($permohonan->jenis_permohonan ?? '')
        );

        $isRehab =
            $jenisPermohonan === 'rehabilitasi' ||
            $jenisPermohonan === 'permohonan rehabilitasi';

        $isSosialisasi =
            $jenisPermohonan === 'sosialisasi' ||
            $jenisPermohonan === 'permohonan sosialisasi';


        /*
        |--------------------------------------------------------------------------
        | LABEL JENIS
        |--------------------------------------------------------------------------
        */

        if ($isRehab) {

            $labelJenis = 'Permohonan Rehabilitasi';

        } elseif ($isSosialisasi) {

            $labelJenis = 'Permohonan Sosialisasi';

        } else {

            $labelJenis = $permohonan->jenis_permohonan ?? '-';

        }

    @endphp


    <div class="modal fade" id="detailPermohonanModal" tabindex="-1" aria-labelledby="detailPermohonanModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">


                {{-- =====================================================
                HEADER
                ====================================================== --}}

                <div id="modalHeader" class="modal-header bg-primary text-white">

                    <h5 class="modal-title fw-bold" id="detailPermohonanModalLabel">

                        <i class="bi bi-file-earmark-medical me-2"></i>

                        Detail Tindak Lanjut Permohonan

                    </h5>


                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>

                </div>



                {{-- =====================================================
                BODY
                ====================================================== --}}

                <div class="modal-body p-4">

                    <div class="row g-4 align-items-start">


                        {{-- =================================================
                        FOTO / FILE
                        ================================================== --}}

                        <div class="col-md-5">

                            <div id="modalFileContainer">

                                {{-- Diisi Javascript --}}

                            </div>

                        </div>



                        {{-- =================================================
                        INFORMASI
                        ================================================== --}}

                        <div class="col-md-7">


                            {{-- KODE --}}

                            <h4 class="fw-bold mb-1">

                                {{ $permohonan->kode_permohonan ?? '-' }}

                            </h4>


                            {{-- JENIS --}}

                            <span class="text-muted">

                                {{ $labelJenis }}

                            </span>


                            <hr>


                            {{-- =================================================
                            STATUS
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Status
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    <span id="modalStatus" class="badge bg-primary px-3 py-2">

                                        -

                                    </span>

                                </div>

                            </div>



                            {{-- =================================================
                            INFORMASI REHABILITASI
                            ================================================== --}}

                            @if($isRehab)

                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Nama Pemohon
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->nama_pemohon ?? '-' }}

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        NIK
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->nik ?? '-' }}

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        No. WhatsApp
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        @if($permohonan->no_hp)

                                            {{ substr($permohonan->no_hp, 0, 4) }}
                                            ******
                                            {{ substr($permohonan->no_hp, -3) }}

                                        @else

                                            -

                                        @endif

                                    </div>

                                </div>



                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Alamat Pemohon
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->alamat_pemohon ?? '-' }}

                                    </div>

                                </div>


                                {{-- =================================================
                                INFORMASI SOSIALISASI
                                ================================================== --}}

                            @elseif($isSosialisasi)


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Nama Penyelenggara
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->nama_penyelenggara ?? '-' }}

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Penanggungjawab
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->penanggung_jawab ?? '-' }}

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        No. WhatsApp
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        @if($permohonan->no_hp)

                                            {{ substr($permohonan->no_hp, 0, 4) }}
                                            ******
                                            {{ substr($permohonan->no_hp, -3) }}

                                        @else

                                            -

                                        @endif

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Jumlah Peserta
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->jumlah_peserta ?? 0 }}
                                        Orang

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Tanggal Kegiatan
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        @if($permohonan->tanggal_kegiatan)

                                                                    {{ \Carbon\Carbon::parse(
                                                $permohonan->tanggal_kegiatan
                                            )->translatedFormat('d F Y') }}

                                        @else

                                            -

                                        @endif

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Waktu Kegiatan
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->waktu_kegiatan ?? '-' }}

                                    </div>

                                </div>


                                <div class="detail-row mb-3">

                                    <div class="detail-label fw-bold">
                                        Tempat Kegiatan
                                    </div>

                                    <div class="detail-colon">
                                        :
                                    </div>

                                    <div class="detail-value">

                                        {{ $permohonan->tempat ?? '-' }}

                                    </div>

                                </div>


                            @else

                                <div class="alert alert-warning">

                                    Jenis permohonan tidak dikenali.

                                </div>

                            @endif



                            {{-- =================================================
                            TANGGAL UPDATE
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Tanggal Update
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value" id="modalTanggalUpdate">

                                    -

                                </div>

                            </div>



                            {{-- =================================================
                            DIUPDATE OLEH
                            ================================================== --}}

                            <div class="detail-row mb-3">

                                <div class="detail-label fw-bold">
                                    Diupdate Oleh
                                </div>

                                <div class="detail-colon">
                                    :
                                </div>

                                <div class="detail-value">

                                    {{ $permohonan->admin->nama ?? 'Admin BNNK Tulungagung' }}

                                </div>

                            </div>



                            {{-- =================================================
                            CATATAN ADMIN
                            ================================================== --}}

                            <div class="mt-4">

                                <label class="fw-bold mb-2">

                                    <i class="bi bi-journal-text me-1"></i>

                                    Catatan Admin

                                </label>


                                <div id="modalCatatan" class="border rounded-3 bg-light p-3">

                                    <span class="text-muted">

                                        Belum ada catatan dari admin.

                                    </span>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>



                {{-- =====================================================
                FOOTER
                ====================================================== --}}

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle me-1"></i>

                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const modal = document.getElementById('detailPermohonanModal');

            if (!modal) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | DATA DARI DATABASE
            |--------------------------------------------------------------------------
            */

            const detailPermohonan = {

                Diverifikasi: {

                    status: 'Diverifikasi',

                    warna: 'primary',

                    tanggal: @json(
                        $permohonan->tanggal_verifikasi
                        ? \Carbon\Carbon::parse($permohonan->tanggal_verifikasi)
                            ->translatedFormat('d F Y • H:i') . ' WIB'
                        : null
                    ),

                    catatan: @json(
                        $permohonan->catatan_verifikasi
                    ),

                    file: @json(
                        $permohonan->file_verifikasi
                    )

                },


                Diproses: {

                    status: 'Diproses BNNK',

                    warna: 'warning',

                    tanggal: @json(
                        $permohonan->tanggal_proses
                        ? \Carbon\Carbon::parse($permohonan->tanggal_proses)
                            ->translatedFormat('d F Y • H:i') . ' WIB'
                        : null
                    ),

                    catatan: @json(
                        $permohonan->catatan_proses
                    ),

                    file: @json(
                        $permohonan->file_proses
                    )

                },


                Selesai: {

                    status: 'Selesai',

                    warna: 'success',

                    tanggal: @json(
                        $permohonan->tanggal_selesai
                        ? \Carbon\Carbon::parse($permohonan->tanggal_selesai)
                            ->translatedFormat('d F Y • H:i') . ' WIB'
                        : null
                    ),

                    catatan: @json(
                        $permohonan->catatan_selesai
                    ),

                    file: @json(
                        $permohonan->file_selesai
                    )

                },


                Ditolak: {

                    status: 'Ditolak',

                    warna: 'danger',

                    tanggal: @json(
                        $permohonan->tanggal_verifikasi
                        ? \Carbon\Carbon::parse($permohonan->tanggal_verifikasi)
                            ->translatedFormat('d F Y • H:i') . ' WIB'
                        : null
                    ),

                    catatan: @json(
                        $permohonan->catatan_verifikasi
                    ),

                    file: @json(
                        $permohonan->file_verifikasi
                    )

                }

            };


            /*
            |--------------------------------------------------------------------------
            | ELEMENT MODAL
            |--------------------------------------------------------------------------
            */

            const modalStatus =
                document.getElementById('modalStatus');

            const modalTanggal =
                document.getElementById('modalTanggalUpdate');

            const modalCatatan =
                document.getElementById('modalCatatan');

            const modalFile =
                document.getElementById('modalFileContainer');

            const modalHeader =
                document.getElementById('modalHeader');


            /*
            |--------------------------------------------------------------------------
            | KETIKA TOMBOL LIHAT DETAIL DIKLIK
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll('[data-status-detail]')
                .forEach(function (button) {

                    button.addEventListener('click', function () {

                        const status =
                            this.getAttribute('data-status-detail');


                        const data =
                            detailPermohonan[status];


                        if (!data) {
                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | STATUS
                        |--------------------------------------------------------------------------
                        */

                        modalStatus.textContent =
                            data.status;


                        modalStatus.className =
                            'badge px-3 py-2';


                        if (data.warna === 'warning') {

                            modalStatus.classList.add(
                                'bg-warning',
                                'text-dark'
                            );

                        } else {

                            modalStatus.classList.add(
                                'bg-' + data.warna
                            );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | HEADER
                        |--------------------------------------------------------------------------
                        */

                        modalHeader.className =
                            'modal-header';


                        if (data.warna === 'warning') {

                            modalHeader.classList.add(
                                'bg-warning'
                            );

                        } else {

                            modalHeader.classList.add(
                                'bg-' + data.warna,
                                'text-white'
                            );

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | TANGGAL UPDATE
                        |--------------------------------------------------------------------------
                        */

                        if (data.tanggal) {

                            modalTanggal.textContent =
                                data.tanggal;

                        } else {

                            modalTanggal.textContent =
                                '-';

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | CATATAN
                        |--------------------------------------------------------------------------
                        */

                        if (data.catatan) {

                            modalCatatan.innerHTML =
                                data.catatan
                                    .replace(/\n/g, '<br>');

                        } else {

                            modalCatatan.innerHTML = `
                                <span class="text-muted">
                                    Belum ada catatan dari admin.
                                </span>
                            `;

                        }


                        /*
                        |--------------------------------------------------------------------------
                        | FILE / FOTO
                        |--------------------------------------------------------------------------
                        */

                        if (data.file) {

                            const fileUrl =
                                "{{ asset('storage') }}/" + data.file;


                            const extension =
                                data.file
                                    .split('.')
                                    .pop()
                                    .toLowerCase();


                            /*
                            |--------------------------------------------------------------
                            | GAMBAR
                            |--------------------------------------------------------------
                            */

                            if (
                                ['jpg', 'jpeg', 'png', 'webp', 'gif']
                                    .includes(extension)
                            ) {

                                modalFile.innerHTML = `

                                    <div class="text-center">

                                        <img src="${fileUrl}"
                                            alt="Bukti Tindak Lanjut"
                                            class="img-fluid rounded-3 shadow-sm border"
                                            style="
                                                max-width:100%;
                                                max-height:350px;
                                                object-fit:contain;
                                            ">

                                        <div class="mt-3">

                                            <a href="${fileUrl}"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-primary">



                                            <i class="bi bi-box-arrow-up-right me-1"></i>

                                        Buka Lampiran


                                            </a>

                                        </div>

                                    </div>

                                `;

                                }

                                /*
                                |--------------------------------------------------------------
                                | PDF
                                |--------------------------------------------------------------
                                */

                                else if (extension === 'pdf') {

                                    modalFile.innerHTML = `

                                    <div class="border rounded-3 bg-light
                                        d-flex flex-column
                                        justify-content-center
                                        align-items-center
                                        text-muted"
                                        style="height:300px;">

                                        <i class="bi bi-file-earmark-pdf-fill text-danger"
                                            style="font-size:70px;">
                                        </i>

                                        <span class="mt-2">

                                            Dokumen PDF

                                        </span>

                                        <a href="${fileUrl}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-danger mt-3">

                                            <i class="bi bi-eye-fill me-1"></i>

                                            Lihat Dokumen

                                        </a>

                                    </div>

                                `;

                                }

                                /*
                                |--------------------------------------------------------------
                                | FILE LAIN
                                |--------------------------------------------------------------
                                */

                                else {

                                    modalFile.innerHTML = `

                                    <div class="border rounded-3 bg-light
                                        d-flex flex-column
                                        justify-content-center
                                        align-items-center
                                        text-muted"
                                        style="height:300px;">

                                        <i class="bi bi-file-earmark"
                                            style="font-size:70px;">
                                        </i>

                                        <span class="mt-2">

                                            File Tindak Lanjut

                                        </span>

                                        <a href="${fileUrl}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-primary mt-3">

                                            <i class="bi bi-download me-1"></i>

                                            Lihat File

                                        </a>

                                    </div>

                                `;

                                }

                            }

                            /*
                            |--------------------------------------------------------------------------
                            | TIDAK ADA FILE
                            |--------------------------------------------------------------------------
                            */

                            else {

                                modalFile.innerHTML = `

                                <div class="border rounded-3 bg-light
                                    d-flex flex-column
                                    justify-content-center
                                    align-items-center
                                    text-muted"
                                    style="height:300px;">

                                    <i class="bi bi-image"
                                        style="font-size:60px;">
                                    </i>

                                    <span class="mt-2">

                                        Belum ada bukti tindak lanjut

                                    </span>

                                </div>

                            `;

                            }

                        });

                    });

            });

        </script>
@endsection