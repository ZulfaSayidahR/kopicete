@extends('layouts.app')

@section('title', 'Detail Lacak Aduan')

@section('content')

    <section class="tracking-page">

        <div class="container">

            <!-- HEADER -->
            <div class="tracking-header">

                <div class="logo-box">

                    <div>

                        <h4>BNNK Tulungagung</h4>

                        <small class="text-white">
                            Sistem Pelacakan Pengaduan Masyarakat
                        </small>

                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="tracking-body">

                <div class="tracking-grid">

                    <!-- ==============================
                                                                                                                                                                        KOLOM KIRI
                                                                                                                                                                =============================== -->

                    <div class="tracking-left">

                        <!-- INFORMASI -->
                        <div class="tracking-card mb-4">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h5 class="mb-0">
                                    Informasi Pengaduan
                                </h5>

                                <span
                                    class="badge
                                                                                                                        @if($pengaduan->status == 'Menunggu')
                                                                                                                            bg-warning
                                                                                                                        @elseif($pengaduan->status == 'Diproses')
                                                                                                                            bg-primary
                                                                                                                        @elseif($pengaduan->status == 'Selesai')
                                                                                                                            bg-success
                                                                                                                        @else
                                                                                                                            bg-secondary
                                                                                                                        @endif">

                                    {{ $pengaduan->status }}

                                </span>

                            </div>

                            <div class="info-grid">

                                <div>

                                    <strong>
                                        <i class="bi bi-upc-scan"></i>
                                        Kode Aduan
                                    </strong>

                                    <p>

                                        @if($pengaduan->kode_aduan)

                                            {{ substr($pengaduan->kode_aduan, 0, 4) }}
                                            ******
                                            {{ substr($pengaduan->kode_aduan, -3) }}

                                        @else

                                            -

                                        @endif

                                    </p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-geo-alt-fill"></i>
                                        Kecamatan
                                    </strong>

                                    <p>{{ $kecamatan->nama_kecamatan ?? '-' }}</p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-tags-fill"></i>
                                        Topik Aduan
                                    </strong>

                                    <p>{{ $pengaduan->topik_aduan }}</p>

                                </div>

                                <div>

                                    <strong>
                                        <i class="bi bi-whatsapp"></i>
                                        No WhatsApp
                                    </strong>

                                    <p>

                                        @if($pengaduan->no_whatsapp)

                                            {{ substr($pengaduan->no_whatsapp, 0, 4) }}
                                            ******
                                            {{ substr($pengaduan->no_whatsapp, -3) }}

                                        @else

                                            -

                                        @endif

                                    </p>

                                </div>

                            </div>

                            <div class="kronologi">

                                <h6>

                                    <i class="bi bi-file-text-fill"></i>

                                    Kronologi

                                </h6>

                                <div class="kronologi-box">

                                    {{ $pengaduan->detail_aduan }}

                                </div>

                            </div>

                        </div>

                        <!-- LAMPIRAN -->

                        <div class="tracking-card">

                            <h5>

                                <i class="bi bi-paperclip"></i>

                                Lampiran Bukti

                            </h5>

                            @if($pengaduan->lampiran)

                                <div class="text-center mt-3">

                                    <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" class="img-fluid rounded shadow"
                                        style="max-height:350px;">

                                </div>

                            @else

                                <div class="alert alert-light text-center mt-3">

                                    <i class="bi bi-image fs-2 d-block mb-2"></i>

                                    Tidak ada lampiran yang diunggah.

                                </div>

                            @endif

                        </div>

                    </div>

                    <!-- ==============================
                                                                                                                                                                        KOLOM KANAN
                                                                                                                                                                =============================== -->

                    <aside class="tracking-card status-card">

                        <h5>
                            <i class="bi bi-clock-history"></i>
                            Riwayat Status
                        </h5>

                        <div class="tracking-timeline">


                            {{-- ================= DIAJUKAN ================= --}}
                            <div class="tracking-item selesai">

                                <div class="tracking-icon">

                                    <i class="bi bi-check-lg"></i>

                                </div>


                                <div class="tracking-content">

                                    <h6>Pengaduan Diajukan</h6>


                                    <small class="d-block">

                                        <i class="bi bi-calendar-event me-1"></i>

                                        {{ $pengaduan->created_at->translatedFormat('d F Y H:i') }}

                                    </small>

                                </div>

                            </div>



                            {{-- ================= DIVERIFIKASI ================= --}}

                            @php

                                $verifikasiSelesai = in_array(
                                    $pengaduan->status,
                                    [
                                        'Diverifikasi',
                                        'Diproses',
                                        'Selesai'
                                    ]
                                );

                            @endphp


                            <div class="tracking-item {{ $verifikasiSelesai ? 'selesai' : '' }}">


                                <div class="tracking-icon">


                                    @if($verifikasiSelesai)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-circle"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>
                                        Diverifikasi Admin
                                    </h6>



                                    @if($pengaduan->tanggal_verifikasi)


                                        <small class="d-block mb-2">


                                            <i class="bi bi-calendar-event me-1"></i>


                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_verifikasi)->translatedFormat('d F Y H:i') }}


                                        </small>



                                        <!-- <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                            data-bs-target="#detailLaporanModal">


                                                            <i class="bi bi-eye-fill"></i>

                                                            Lihat Detail


                                                        </button> -->


                                    @else

                                        <small class="text-muted">

                                            Menunggu verifikasi admin

                                        </small>


                                    @endif


                                </div>


                            </div>





                            {{-- ================= DIPROSES ================= --}}

                            @php

                                $prosesSelesai = in_array(
                                    $pengaduan->status,
                                    [
                                        'Diproses',
                                        'Selesai'
                                    ]
                                );

                            @endphp



                            <div class="tracking-item {{ $prosesSelesai ? 'selesai' : '' }}">


                                <div class="tracking-icon">


                                    @if($prosesSelesai)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-hourglass-split"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>
                                        Diproses BNNK
                                    </h6>



                                    @if($pengaduan->tanggal_proses)


                                        <small class="d-block mb-2">


                                            <i class="bi bi-calendar-event me-1"></i>


                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('d F Y H:i') }}


                                        </small>



                                        <!-- <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                                    data-bs-target="#detailLaporanModal">


                                                    <i class="bi bi-eye-fill"></i>

                                                    Lihat Detail


                                                </button> -->


                                    @else


                                        <small class="text-muted">

                                            Menunggu proses BNNK

                                        </small>


                                    @endif



                                </div>


                            </div>






                            {{-- ================= SELESAI ================= --}}


                            @php

                                $selesai = $pengaduan->status == 'Selesai';

                            @endphp



                            <div class="tracking-item {{ $selesai ? 'selesai' : '' }}">


                                <div class="tracking-icon">


                                    @if($selesai)

                                        <i class="bi bi-check-circle-fill"></i>

                                    @else

                                        <i class="bi bi-flag"></i>

                                    @endif


                                </div>



                                <div class="tracking-content">


                                    <h6>
                                        Selesai
                                    </h6>



                                    @if($pengaduan->tanggal_selesai)


                                        <small class="d-block mb-2">


                                            <i class="bi bi-calendar-event me-1"></i>


                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d F Y H:i') }}


                                        </small>


                                    @else


                                        <small class="text-muted">

                                            Belum selesai

                                        </small>


                                    @endif


                                </div>


                            </div>


                        </div>


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