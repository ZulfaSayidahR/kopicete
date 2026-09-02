@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                                                                            FORM STEP 3
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

                            <div class="step active">
                                <div class="step-number">
                                    3
                                </div>
                                <div class="step-title">
                                    Data Pelapor
                                </div>
                            </div>

                            <div class="step">
                                <div class="step-number">
                                    4
                                </div>
                                <div class="step-title">
                                    Konfirmasi
                                </div>
                            </div>

                        </div>

                        <!-- FORM -->

                        <form action="{{ route('pengaduan.storeStep3') }}" method="POST">

                            @csrf

                            @if ($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach ($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif


                            {{-- =====================================================
                            NAMA LENGKAP
                            ====================================================== --}}

                            <div class="mb-3">

                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input type="text" class="form-control" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('nama_lengkap', $step3['nama_lengkap'] ?? '') }}" required>

                            </div>


                            {{-- =====================================================
                            NOMOR WHATSAPP
                            ====================================================== --}}

                            <div class="mb-3">

                                <label class="form-label">
                                    Nomor WhatsApp
                                </label>

                                <input type="text" class="form-control" name="no_whatsapp"
                                    placeholder="Contoh : 081234567890"
                                    value="{{ old('no_whatsapp', $step3['no_whatsapp'] ?? '') }}" required>

                                <div class="form-note">

                                    Pastikan nomor WhatsApp yang diberikan aktif,
                                    karena petugas dapat menghubungi Anda melalui nomor tersebut
                                    untuk proses verifikasi atau tindak lanjut laporan.

                                </div>

                            </div>


                            {{-- =====================================================
                            EMAIL
                            ====================================================== --}}

                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email" class="form-control" name="email"
                                    placeholder="Masukkan email aktif (opsional)"
                                    value="{{ old('email', $step3['email'] ?? '') }}">

                                <div class="form-note">

                                    Email bersifat opsional dan digunakan apabila diperlukan
                                    untuk informasi tambahan terkait laporan.

                                </div>

                            </div>


                            {{-- =====================================================
                            ALAMAT DOMISILI
                            ====================================================== --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Alamat Domisili
                                </label>

                                <textarea class="form-control" name="alamat_domisili" rows="4"
                                    placeholder="Masukkan alamat lengkap"
                                    required>{{ old('alamat_domisili', $step3['alamat_domisili'] ?? '') }}</textarea>

                            </div>


                            {{-- =====================================================
                            KONFIRMASI DATA
                            ====================================================== --}}

                            <div class="alert alert-info">

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="konfirmasi_data" value="1"
                                        id="konfirmasi_data" required {{ old('konfirmasi_data', $step3['konfirmasi_data'] ?? '') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="konfirmasi_data">

                                        Saya memastikan data pribadi yang saya masukkan
                                        adalah benar dan dapat dipertanggungjawabkan.

                                    </label>

                                </div>

                            </div>


                            {{-- =====================================================
                            NAVIGASI
                            ====================================================== --}}

                            <div class="form-navigation">

                                <a href="{{ route('pengaduan.lokasi') }}" class="btn btn-secondary d-flex align-items-center justify-content-center fw-semibold">

                                    Sebelumnya

                                </a>


                                <button type="submit" class="btn-next">

                                    Selanjutnya

                                </button>

                            </div>

                        </form>
                    </div>

                </div>


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