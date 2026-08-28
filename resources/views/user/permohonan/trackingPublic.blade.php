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


                                <span class="badge
                                                            @if($permohonan->status == 'Menunggu')
                                                                bg-warning
                                                            @elseif($permohonan->status == 'Diproses')
                                                                bg-primary
                                                            @elseif($permohonan->status == 'Selesai')
                                                                bg-success
                                                            @elseif($permohonan->status == 'Ditolak')
                                                                bg-danger
                                                            @else
                                                                bg-secondary
                                                            @endif">

                                    {{ $permohonan->status }}

                                </span>

                            </div>


                            <div class="info-grid">


                                {{-- KODE --}}
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


                                {{-- JENIS --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-file-earmark-text-fill"></i>

                                        Jenis Permohonan

                                    </strong>

                                    <p>
                                        {{ $permohonan->jenis_permohonan }}
                                    </p>

                                </div>


                                {{-- PENYELENGGARA --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-building-fill"></i>

                                        Nama Penyelenggara

                                    </strong>

                                    <p>
                                        {{ $permohonan->nama_penyelenggara }}
                                    </p>

                                </div>


                                {{-- PENANGGUNG JAWAB --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-person-fill"></i>

                                        Penanggungjawab

                                    </strong>

                                    <p>
                                        {{ $permohonan->penanggung_jawab }}
                                    </p>

                                </div>


                                {{-- NO HP --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-whatsapp"></i>

                                        No. HP

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
                                        {{ $permohonan->jumlah_peserta }} orang
                                    </p>

                                </div>


                                {{-- TANGGAL KEGIATAN --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-calendar-event-fill"></i>

                                        Tanggal Kegiatan

                                    </strong>

                                    <p>

                                        {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->translatedFormat('d F Y') }}

                                    </p>

                                </div>


                                {{-- WAKTU --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-clock-fill"></i>

                                        Waktu Kegiatan

                                    </strong>

                                    <p>
                                        {{ $permohonan->waktu_kegiatan }}
                                    </p>

                                </div>


                                {{-- TEMPAT --}}
                                <div>

                                    <strong>

                                        <i class="bi bi-geo-alt-fill"></i>

                                        Tempat Kegiatan

                                    </strong>

                                    <p>
                                        {{ $permohonan->tempat }}
                                    </p>

                                </div>

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
                        <!-- <div class="tracking-card">

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

                        </div> -->

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



                                                                    <!-- <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal">


                                                                        <i class="bi bi-eye-fill"></i>

                                                                        Lihat Detail


                                                                    </button> -->


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


<!-- 
                                                                    <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal">


                                                                        <i class="bi bi-eye-fill"></i>

                                                                        Lihat Detail


                                                                    </button> -->



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




                                                                    <!-- <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal"
                                                                        data-bs-target="#detailPermohonanModal">


                                                                        <i class="bi bi-eye-fill"></i>

                                                                        Lihat Detail


                                                                    </button> -->



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

@endsection