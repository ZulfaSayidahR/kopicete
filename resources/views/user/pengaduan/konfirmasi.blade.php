@extends('layouts.app')

@section('title', 'Konfirmasi Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                                                                                                                                    FORM KONFIRMASI
                                                                                                                            =========================================== -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Pengaduan</h4>

                        <p>
                            Sampaikan keluhan atau saran Anda dengan lengkap.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <!-- STEP -->

                        <div class="stepper">

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Data Aduan
                                </div>
                            </div>

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Lokasi & Lampiran
                                </div>
                            </div>

                            <div class="step selesai">
                                <div class="step-number">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div class="step-title">
                                    Data Pelapor
                                </div>
                            </div>

                            <div class="step active">
                                <div class="step-number">
                                    4
                                </div>
                                <div class="step-title">
                                    Konfirmasi
                                </div>
                            </div>

                        </div>

                        <!-- RINGKASAN -->

                        <!-- RINGKASAN -->

                        <div class="summary-card">


                            <div class="summary-header">

                                <i class="bi bi-clipboard-data"></i>

                                Ringkasan Aduan

                            </div>



                            <div class="summary-body">


                                <div class="row">


                                    <!-- DATA ADUAN -->

                                    <div class="col-md-7">


                                        <h6>
                                            Data Aduan
                                        </h6>


                                        <p>

                                            <strong>Judul :</strong>

                                            {{ $step1['judul_aduan'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Topik :</strong>

                                            {{ $step1['topik_aduan'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Isi Aduan :</strong>

                                        </p>


                                        <div class="summary-detail">

                                            {{ $step1['detail_aduan'] ?? '-' }}

                                        </div>
                                    </div>




                                    <!-- DATA PRIBADI -->

                                    <div class="col-md-5">


                                        <h6>
                                            Data Pribadi
                                        </h6>



                                        <p>

                                            <strong>Nama :</strong>

                                            {{ $step3['nama_lengkap'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>No WhatsApp :</strong>

                                            {{ $step3['no_whatsapp'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Email :</strong>

                                            {{ $step3['email'] ?? '-' }}

                                        </p>



                                        <p>

                                            <strong>Alamat :</strong>

                                            {{ $step3['alamat_domisili'] ?? '-' }}

                                        </p>


                                    </div>


                                </div>




                                <hr>




                                <!-- DATA LOKASI -->


                                <div class="mt-4">


                                    <h6>
                                        Lokasi Kejadian
                                    </h6>


                                    <strong>Alamat :</strong>

                                    {{ $step2['alamat_kejadian'] ?? '-' }}



                                    <p>
                                        <strong>Kecamatan :</strong>

                                        {{ $kecamatan->nama_kecamatan ?? '-' }}

                                    </p>


                                    <p>
                                        <strong>Desa :</strong>

                                        {{ $desa->nama_desa ?? '-' }}

                                    </p>

                                </div>




                                @if(!empty($step2['lampiran']))

                                    <div class="mt-4">

                                        <h6 class="fw-bold mb-3">
                                            <i class="bi bi-paperclip"></i>
                                            Lampiran Bukti
                                        </h6>

                                        <div class="card border-0 shadow-sm">

                                            <div class="card-body text-center">

                                                @if(Storage::disk('public')->exists($step2['lampiran']))

                                                    <img src="{{ asset('storage/' . $step2['lampiran']) }}" alt="Lampiran Bukti"
                                                        class="img-fluid rounded shadow-sm"
                                                        style="max-height:350px; object-fit:contain;">

                                                    <div class="mt-3">
                                                        <a href="{{ asset('storage/' . $step2['lampiran']) }}" target="_blank"
                                                            class="btn btn-primary btn-sm">

                                                            <i class="bi bi-arrows-fullscreen"></i>
                                                            Lihat Ukuran Penuh

                                                        </a>
                                                    </div>

                                                @else

                                                    <div class="alert alert-warning mb-0">

                                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                                        File lampiran tidak ditemukan.

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @endif



                            </div>


                        </div>

                        <form action="{{ route('pengaduan.kirimOtp') }}" method="POST">

                            @csrf

                            <!-- PERSETUJUAN -->

                            <div class="card border-0 shadow-sm mt-4">

                                <div class="card-body">

                                    <div class="form-check d-flex align-items-start">

                                        <input class="form-check-input mt-1" type="checkbox" name="persetujuan"
                                            id="persetujuan" value="1" required>

                                        <div class="ms-3">

                                            <label for="persetujuan" class="fw-bold mb-2 d-block">

                                                Saya menyatakan bahwa:

                                            </label>

                                            <ul class="mb-0">

                                                <li>Data yang saya isi adalah benar dan dapat dipertanggungjawabkan.</li>

                                                <li>Saya bersedia dilakukan proses verifikasi oleh BNNK Tulungagung.</li>

                                                <li>Saya memahami bahwa memberikan laporan palsu dapat dikenakan sanksi
                                                    sesuai
                                                    ketentuan yang berlaku.</li>

                                            </ul>

                                        </div>

                                    </div>

                                    @error('persetujuan')

                                        <small class="text-danger d-block mt-2">

                                            {{ $message }}

                                        </small>

                                    @enderror

                                </div>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">

                                    Verifikasi Keamanan

                                </label>

                                <div class="mb-3">

                                    {!! NoCaptcha::display() !!}

                                    @error('g-recaptcha-response')

                                        <small class="text-danger">

                                            {{ $message }}

                                        </small>

                                    @enderror

                                </div>

                            </div>

                            <!-- BUTTON -->


                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.datapribadi') }}" class="btn btn-secondary">
                                    Sebelumnya
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send-fill me-2"></i>
                                    Kirim Pengaduan
                                </button>

                            </div>

                        </form>
                    </div>

                </div>

                <!-- ==========================================
                                                                                                                                    SIDEBAR
                                                                                                                            =========================================== -->

                <aside class="sidebar-aduan">

                    <div class="aduan-terbaru-header">

                        <h4>Aduan Terbaru</h4>

                    </div>

                    {{-- SEARCH ADUAN --}}
                    <div class="search-adukan-box">

                        <form action="{{ route('pengaduan.cari') }}" method="GET">

                            <div class="search-adukan-wrapper">

                                <div class="search-input-wrapper">

                                    <i class="bi bi-search"></i>

                                    <input
                                        type="text"
                                        name="topik"
                                        value="{{ request('topik') }}"
                                        placeholder="Cari berdasarkan topik aduan..."
                                        autocomplete="off"
                                    >

                                </div>

                                <button type="submit" class="btn-search-adukan">

                                    <i class="bi bi-search"></i>

                                    Cari

                                </button>

                            </div>

                        </form>

                    </div>

                    @forelse($aduanTerbaru as $item)

                        <div class="aduan-item">

                            <span class="status
                                @if($item->status == 'Menunggu') menunggu
                                @elseif($item->status == 'Diproses') proses
                                @elseif($item->status == 'Selesai') selesai
                                @elseif($item->status == 'Ditolak') ditolak
                                @else verifikasi
                                @endif">

                                {{ $item->status }}

                            </span>

                            <h6>

                                {{ Str::limit($item->judul_aduan, 40) }}

                            </h6>

                            <small>

                                <i class="bi bi-geo-alt-fill"></i>

                                {{ $item->kecamatan->nama_kecamatan ?? '-' }}

                            </small>

                            <small>

                                <i class="bi bi-calendar-event-fill"></i>

                                {{ $item->created_at->translatedFormat('d F Y') }}

                            </small>

                            <a href="{{ route('pengaduan.tracking', $item->kode_aduan) }}" class="btn-detail-laporan">

                                <i class="bi bi-eye-fill"></i>

                                Lihat Tracking

                            </a>

                        </div>

                    @empty

                        <div class="alert alert-light">

                            Belum ada aduan.

                        </div>

                    @endforelse


                </aside>

                <!-- Modal Detail Aduan -->
                <div class="modal fade" id="detailLaporanModal" tabindex="-1">

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Detail Tindak Lanjut Aduan
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="row">

                                    <!-- Gambar -->
                                    <div class="col-md-5">

                                        <img src="{{ asset('images/bukti-default.jpg') }}" class="img-fluid rounded shadow"
                                            alt="Bukti">

                                    </div>

                                    <!-- Informasi -->
                                    <div class="col-md-7">

                                        <h5>
                                            Dugaan Penyalahgunaan Narkotika
                                        </h5>

                                        <hr>

                                        <p>

                                            <strong>Status :</strong>

                                            <span class="badge bg-warning text-dark">

                                                Verifikasi

                                            </span>

                                        </p>

                                        <p>

                                            <strong>Admin :</strong>

                                            Admin BNNK Tulungagung

                                        </p>

                                        <p>

                                            <strong>Tanggal Penanganan :</strong>

                                            10 Juli 2026

                                        </p>

                                        <label class="fw-bold">

                                            Catatan Admin

                                        </label>

                                        <div class="border rounded p-3 bg-light">

                                            Tim telah melakukan verifikasi awal
                                            terhadap laporan yang diterima.
                                            Saat ini laporan sedang dalam proses
                                            pendalaman informasi sebelum dilakukan
                                            tindak lanjut lapangan.

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button class="btn btn-secondary" data-bs-dismiss="modal">

                                    Tutup

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection