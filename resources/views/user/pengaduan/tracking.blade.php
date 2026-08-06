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

                                <span class="badge
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

                                    <p>{{ $pengaduan->kode_aduan }}</p>

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

                                    <h6>Diajukan</h6>

                                    <small class="d-block">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $pengaduan->created_at->translatedFormat('d F Y H:i') }}
                                    </small>

                                </div>

                            </div>


                            {{-- ================= DIVERIFIKASI ================= --}}
                            <div class="tracking-item {{ $pengaduan->tanggal_verifikasi ? 'selesai' : '' }}">

                                <div class="tracking-icon">

                                    @if($pengaduan->tanggal_verifikasi)

                                        <i class="bi bi-check-lg"></i>

                                    @else

                                        <i class="bi bi-circle"></i>

                                    @endif

                                </div>

                                <div class="tracking-content">

                                    <h6>Diverifikasi Admin</h6>

                                    @if($pengaduan->tanggal_verifikasi)

                                        <small class="d-block mb-2">

                                            <i class="bi bi-calendar-event me-1"></i>

                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_verifikasi)->translatedFormat('d F Y H:i') }}

                                        </small>

                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalVerifikasi">

                                            <i class="bi bi-eye-fill"></i>

                                            Lihat Detail

                                        </button>

                                    @endif

                                </div>

                            </div>



                            {{-- ================= DIPROSES ================= --}}
                            <div class="tracking-item {{ $pengaduan->tanggal_proses ? 'proses' : '' }}">

                                <div class="tracking-icon">

                                    @if($pengaduan->tanggal_proses)

                                        <i class="bi bi-hourglass-split"></i>

                                    @else

                                        <i class="bi bi-circle"></i>

                                    @endif

                                </div>

                                <div class="tracking-content">

                                    <h6>Diproses BNNK</h6>

                                    @if($pengaduan->tanggal_proses)

                                        <small class="d-block mb-2">

                                            <i class="bi bi-calendar-event me-1"></i>

                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('d F Y H:i') }}

                                        </small>

                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalProses">

                                            <i class="bi bi-eye-fill"></i>

                                            Lihat Detail

                                        </button>

                                    @endif

                                </div>

                            </div>



                            {{-- ================= SELESAI ================= --}}
                            <div class="tracking-item {{ $pengaduan->tanggal_selesai ? 'selesai' : '' }}">

                                <div class="tracking-icon">

                                    @if($pengaduan->tanggal_selesai)

                                        <i class="bi bi-flag-fill"></i>

                                    @else

                                        <i class="bi bi-circle"></i>

                                    @endif

                                </div>

                                <div class="tracking-content">

                                    <h6>Selesai</h6>

                                    @if($pengaduan->tanggal_selesai)

                                        <small class="d-block mb-2">

                                            <i class="bi bi-calendar-event me-1"></i>

                                            {{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d F Y H:i') }}

                                        </small>

                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai">

                                            <i class="bi bi-eye-fill"></i>

                                            Lihat Detail

                                        </button>

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


    <!-- Modal Verifikasi -->
<div class="modal fade" id="modalVerifikasi" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    <i class="bi bi-patch-check-fill"></i>
                    Detail Verifikasi Admin
                </h5>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-5">

                        @if($pengaduan->foto_verifikasi)

                            <img src="{{ asset('storage/'.$pengaduan->foto_verifikasi) }}"
                                 class="img-fluid rounded shadow">

                        @else

                            <div class="alert alert-light text-center">

                                <i class="bi bi-image fs-1"></i>

                                <p class="mb-0">
                                    Belum ada foto verifikasi
                                </p>

                            </div>

                        @endif

                    </div>

                    <div class="col-md-7">

                        <h5>{{ $pengaduan->judul_aduan }}</h5>

                        <hr>

                        <p>

                            <strong>Status :</strong>

                            <span class="badge bg-primary">

                                Diverifikasi

                            </span>

                        </p>

                        <p>

                            <strong>Tanggal :</strong>

                            {{ $pengaduan->tanggal_verifikasi
                                ? \Carbon\Carbon::parse($pengaduan->tanggal_verifikasi)->translatedFormat('d F Y H:i')
                                : '-' }}

                        </p>

                        <label class="fw-bold">

                            Catatan Admin

                        </label>

                        <div class="border rounded p-3 bg-light">

                            {!! nl2br(e($pengaduan->catatan_verifikasi ?? 'Belum ada catatan.')) !!}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal Diproses -->
<div class="modal fade" id="modalProses" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">

                    <i class="bi bi-hourglass-split"></i>

                    Detail Proses Penanganan

                </h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-5">

                        @if($pengaduan->foto_proses)

                            <img src="{{ asset('storage/'.$pengaduan->foto_proses) }}"
                                 class="img-fluid rounded shadow">

                        @else

                            <div class="alert alert-light text-center">

                                <i class="bi bi-image fs-1"></i>

                                <p class="mb-0">

                                    Belum ada foto proses

                                </p>

                            </div>

                        @endif

                    </div>

                    <div class="col-md-7">

                        <h5>{{ $pengaduan->judul_aduan }}</h5>

                        <hr>

                        <p>

                            <strong>Status :</strong>

                            <span class="badge bg-warning">

                                Diproses

                            </span>

                        </p>

                        <p>

                            <strong>Tanggal :</strong>

                            {{ $pengaduan->tanggal_proses
                                ? \Carbon\Carbon::parse($pengaduan->tanggal_proses)->translatedFormat('d F Y H:i')
                                : '-' }}

                        </p>

                        <label class="fw-bold">

                            Catatan Admin

                        </label>

                        <div class="border rounded p-3 bg-light">

                            {!! nl2br(e($pengaduan->catatan_proses ?? 'Belum ada catatan.')) !!}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal Selesai -->
<div class="modal fade" id="modalSelesai" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    <i class="bi bi-check-circle-fill"></i>

                    Pengaduan Telah Selesai

                </h5>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-5">

                        @if($pengaduan->foto_selesai)

                            <img src="{{ asset('storage/'.$pengaduan->foto_selesai) }}"
                                 class="img-fluid rounded shadow">

                        @else

                            <div class="alert alert-light text-center">

                                <i class="bi bi-image fs-1"></i>

                                <p class="mb-0">

                                    Belum ada foto penyelesaian

                                </p>

                            </div>

                        @endif

                    </div>

                    <div class="col-md-7">

                        <h5>{{ $pengaduan->judul_aduan }}</h5>

                        <hr>

                        <p>

                            <strong>Status :</strong>

                            <span class="badge bg-success">

                                Selesai

                            </span>

                        </p>

                        <p>

                            <strong>Tanggal :</strong>

                            {{ $pengaduan->tanggal_selesai
                                ? \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->translatedFormat('d F Y H:i')
                                : '-' }}

                        </p>

                        <label class="fw-bold">

                            Catatan Admin

                        </label>

                        <div class="border rounded p-3 bg-light">

                            {!! nl2br(e($pengaduan->catatan_selesai ?? 'Belum ada catatan.')) !!}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection