@extends('layouts.admin')

@section('title', 'Detail Permohonan')

@section('content')

    <section class="sa-dashboard">

        @include('layouts.sidebar')

        <main class="sa-main">

            {{-- Header --}}
            <header class="sa-topbar">

                <div class="sa-topbar-left">

                    <button class="sa-toggle-sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="sa-page-heading">

                        <h1>Detail Permohonan</h1>

                        <p>Informasi lengkap permohonan masyarakat.</p>

                    </div>

                </div>

            </header>


            <div class="row mt-4">

                {{-- ================= KIRI ================= --}}
                <div class="col-lg-7">

                    {{-- Informasi --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>Informasi Permohonan</h3>
                        </div>

                        <div class="p-4">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <strong>Kode Permohonan</strong>
                                    <p>{{ $permohonan->kode_permohonan }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Jenis Permohonan</strong>
                                    <p>{{ $permohonan->jenis_permohonan }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Nama Penyelenggara</strong>
                                    <p>{{ $permohonan->nama_penyelenggara }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Penanggung Jawab</strong>
                                    <p>{{ $permohonan->penanggung_jawab }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>No. HP</strong>
                                    <p>{{ $permohonan->no_hp }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Jumlah Peserta</strong>
                                    <p>{{ $permohonan->jumlah_peserta }} Orang</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Kegiatan</strong>
                                    <p>
                                        {{ \Carbon\Carbon::parse($permohonan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Waktu Kegiatan</strong>
                                    <p>
                                        {{ \Carbon\Carbon::parse($permohonan->waktu_kegiatan)->format('H:i') }} WIB
                                    </p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <strong>Tempat Kegiatan</strong>
                                    <p>{{ $permohonan->tempat }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Status Permohonan</strong>
                                    <p>
                                        <span class="badge bg-primary">
                                            {{ $permohonan->status }}
                                        </span>
                                    </p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Pengajuan</strong>
                                    <p>
                                        {{ $permohonan->created_at ? $permohonan->created_at->translatedFormat('d F Y H:i') : '-' }}
                                    </p>
                                </div>

                            </div>

                            <hr>

                            <strong>Keterangan / Tujuan Permohonan</strong>

                            <p>
                                {{ $permohonan->keterangan ?? '-' }}
                            </p>

                            @if($permohonan->lampiran)

                                <hr>

                                <strong>Lampiran</strong>

                                <div class="mt-2">

                                    <a href="{{ asset('storage/' . $permohonan->lampiran) }}" target="_blank"
                                        class="btn btn-primary btn-sm">

                                        <i class="bi bi-paperclip"></i>
                                        Lihat Lampiran

                                    </a>

                                </div>

                            @endif

                        </div>
                    </div>


                    {{-- Lampiran --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">
                            <h3>Lampiran Dokumen</h3>
                        </div>

                        <div class="p-4 text-center">

                            <img src="{{ asset('images/contoh.jpg') }}" class="img-fluid rounded shadow-sm"
                                style="max-height:350px;">

                            <p class="mt-3 text-muted">

                                Dokumen Pendukung / Surat Permohonan

                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================= KANAN ================= --}}
                <div class="col-lg-5">

                    {{-- Timeline --}}
                    <div class="sa-panel">

                        <div class="sa-panel-header">
                            <h3>
                                <i class="bi bi-clock-history me-2"></i>
                                Riwayat Status
                            </h3>
                        </div>

                        <div class="p-4">

                            <div class="admin-tracking-timeline">

                                {{-- =====================================================
                                PERMOHONAN DIAJUKAN
                                ====================================================== --}}
                                <div class="admin-tracking-item selesai">

                                    <div class="admin-tracking-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>

                                    <div class="admin-tracking-content">

                                        <h6>
                                            Permohonan Diajukan
                                        </h6>

                                        <small>
                                            <i class="bi bi-calendar-event me-1"></i>

                                            @if($permohonan->created_at)
                                                {{ $permohonan->created_at->translatedFormat('d F Y • H:i') }} WIB
                                            @else
                                                -
                                            @endif
                                        </small>

                                    </div>

                                </div>


                                {{-- =====================================================
                                DIVERIFIKASI
                                ====================================================== --}}
                                <div class="admin-tracking-item
                            {{ $permohonan->tanggal_verifikasi ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($permohonan->tanggal_verifikasi)
                                            <i class="bi bi-check-lg"></i>
                                        @else
                                            <i class="bi bi-clock"></i>
                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diverifikasi Admin
                                        </h6>


                                        @if($permohonan->tanggal_verifikasi)

                                                                            <small>
                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $permohonan->tanggal_verifikasi
                                            )->translatedFormat('d F Y • H:i') }} WIB
                                                                            </small>

                                        @else

                                            <small class="text-muted">
                                                Menunggu Verifikasi
                                            </small>

                                        @endif


                                        {{-- CATATAN VERIFIKASI --}}
                                        @if($permohonan->catatan_verifikasi)

                                            <div class="mt-2">

                                                <strong>
                                                    Catatan:
                                                </strong>

                                                <br>

                                                {{ $permohonan->catatan_verifikasi }}

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                {{-- =====================================================
                                DIPROSES
                                ====================================================== --}}
                                <div class="admin-tracking-item
                            {{ $permohonan->tanggal_proses ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($permohonan->tanggal_proses)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-clock"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Diproses BNNK
                                        </h6>


                                        @if($permohonan->tanggal_proses)

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $permohonan->tanggal_proses
                                            )->translatedFormat('d F Y • H:i') }} WIB

                                                                            </small>

                                        @else

                                            <small class="text-muted">
                                                Menunggu Diproses
                                            </small>

                                        @endif


                                        {{-- CATATAN PROSES --}}
                                        @if($permohonan->catatan_proses)

                                            <div class="mt-2">

                                                <strong>
                                                    Catatan:
                                                </strong>

                                                <br>

                                                {{ $permohonan->catatan_proses }}

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                {{-- =====================================================
                                SELESAI
                                ====================================================== --}}
                                <div class="admin-tracking-item
                            {{ $permohonan->tanggal_selesai ? 'selesai' : 'pending' }}">

                                    <div class="admin-tracking-icon">

                                        @if($permohonan->tanggal_selesai)

                                            <i class="bi bi-check-lg"></i>

                                        @else

                                            <i class="bi bi-flag"></i>

                                        @endif

                                    </div>


                                    <div class="admin-tracking-content">

                                        <h6>
                                            Permohonan Selesai
                                        </h6>


                                        @if($permohonan->tanggal_selesai)

                                                                            <small>

                                                                                <i class="bi bi-calendar-event me-1"></i>

                                                                                {{ \Carbon\Carbon::parse(
                                                $permohonan->tanggal_selesai
                                            )->translatedFormat('d F Y • H:i') }} WIB

                                                                            </small>

                                        @else

                                            <small class="text-muted">
                                                Menunggu Penyelesaian
                                            </small>

                                        @endif


                                        {{-- CATATAN SELESAI --}}
                                        @if($permohonan->catatan_selesai)

                                            <div class="mt-2">

                                                <strong>
                                                    Catatan:
                                                </strong>

                                                <br>

                                                {{ $permohonan->catatan_selesai }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                    {{-- Verifikasi --}}
                    <div class="sa-panel mt-4">

                        <div class="sa-panel-header">

                            <h3>Verifikasi Permohonan</h3>

                        </div>

                        <div class="p-4">

                            <form action="{{ route('superadmin.update_permohonan', $permohonan->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                {{-- =========================
                                STATUS
                                ========================== --}}

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Status Permohonan
                                    </label>

                                    <select class="form-select" name="status">

                                        <option>Menunggu Verifikasi</option>

                                        <option>Diverifikasi</option>

                                        <option>Diproses</option>

                                        <option>Ditolak</option>

                                        <option>Selesai</option>

                                    </select>

                                </div>


                                {{-- =========================
                                CATATAN
                                ========================== --}}

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Catatan Admin
                                    </label>

                                    <textarea class="form-control" name="catatan" rows="4"
                                        placeholder="Masukkan catatan verifikasi atau tindak lanjut...">{{ old('catatan') }}</textarea>

                                </div>


                                {{-- =========================
                                FILE BUKTI
                                ========================== --}}

                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Upload Bukti Tindak Lanjut
                                    </label>

                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept=".jpg,.jpeg,.png,.pdf">

                                    <small class="text-muted">
                                        Format JPG, JPEG, PNG, PDF. Maksimal 2 MB.
                                    </small>

                                    {{-- Preview --}}
                                    <div id="previewContainer" class="mt-3" style="display: none;">

                                        {{-- Preview Gambar --}}
                                        <img id="previewBukti" src="" alt="Preview Bukti" class="img-fluid rounded shadow"
                                            style="
                            display: none;
                            max-height: 400px;
                            width: auto;
                         ">

                                        {{-- Preview PDF --}}
                                        <iframe id="previewPdf" src="" style="
                                display: none;
                                width: 100%;
                                height: 500px;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                            ">
                                        </iframe>

                                    </div>

                                </div>


                                {{-- =========================
                                BUTTON
                                ========================== --}}

                                <div class="d-grid">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="bi bi-check-circle-fill"></i>

                                        Simpan Perubahan

                                    </button>

                                </div>

                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </main>

    </section>

    <!-- ==========================================
                                                         MODAL DETAIL TINDAK LANJUT PERMOHONAN
                                                    ========================================== -->
    <div class="modal fade" id="detailPermohonanModal" tabindex="-1" aria-labelledby="detailPermohonanModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="modal-header">

                    <h5 class="modal-title fw-bold" id="detailPermohonanModalLabel">
                        <i class="bi bi-file-earmark-text-fill me-2"></i>
                        Detail Tindak Lanjut Permohonan
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body p-4">

                    <div class="row g-4 align-items-start">

                        <!-- Dokumen / Bukti -->
                        <div class="col-md-5">

                            <img src="{{ asset('images/bukti-default.jpg') }}" class="img-fluid rounded-3 shadow-sm border"
                                alt="Dokumen Permohonan">

                        </div>

                        <!-- Informasi -->
                        <div class="col-md-7">

                            <h4 class="fw-bold mb-3">
                                Permohonan Rehabilitasi
                            </h4>

                            <hr>

                            <p class="mb-3">

                                <strong>Status :</strong>

                                <span class="badge bg-primary px-3 py-2">
                                    Diproses
                                </span>

                            </p>

                            <p class="mb-3">

                                <strong>Petugas/Admin :</strong>

                                Admin BNNK Tulungagung

                            </p>

                            <p class="mb-3">

                                <strong>Tanggal Penanganan :</strong>

                                16 Juli 2026 • 10:45 WIB

                            </p>

                            <label class="fw-bold mb-2">

                                <i class="bi bi-journal-text me-1"></i>

                                Catatan Admin

                            </label>

                            <div class="border rounded-3 bg-light p-3">

                                Dokumen permohonan telah diterima dan
                                diverifikasi oleh Admin BNNK Tulungagung.

                                <br><br>

                                Selanjutnya permohonan diteruskan ke
                                Bidang Rehabilitasi untuk dilakukan
                                pemeriksaan kelengkapan administrasi dan
                                penjadwalan proses layanan.

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle me-1"></i>
                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>
    <script>
        document.getElementById('bukti').addEventListener('change', function (event) {

            const file = event.target.files[0];

            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewBukti');
            const previewPdf = document.getElementById('previewPdf');

            // Reset preview
            previewImage.style.display = 'none';
            previewPdf.style.display = 'none';

            previewImage.src = '';
            previewPdf.src = '';

            if (!file) {
                previewContainer.style.display = 'none';
                return;
            }

            const fileType = file.type;

            // Tampilkan gambar
            if (fileType.startsWith('image/')) {

                const reader = new FileReader();

                reader.onload = function (e) {

                    previewImage.src = e.target.result;

                    previewImage.style.display = 'block';

                    previewContainer.style.display = 'block';
                };

                reader.readAsDataURL(file);

            }

            // Tampilkan PDF
            else if (fileType === 'application/pdf') {

                const fileURL = URL.createObjectURL(file);

                previewPdf.src = fileURL;

                previewPdf.style.display = 'block';

                previewContainer.style.display = 'block';

            }

        });
    </script>
@endsection