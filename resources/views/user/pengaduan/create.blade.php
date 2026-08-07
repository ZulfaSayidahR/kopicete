@extends('layouts.app')

@section('title', 'Portal Pengaduan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-wrapper">

                <!-- ==========================================
                                                                            FORM PENGADUAN
                                                                    =========================================== -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Pengaduan</h4>

                        <p>
                            Sampaikan keluhan atau laporan Anda dengan lengkap.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <!-- STEP -->

                        <div class="stepper">

                            <div class="step active">

                                <div class="step-number">1</div>

                                <div class="step-title">
                                    Data Aduan
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">2</div>

                                <div class="step-title">
                                    Lokasi
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">3</div>

                                <div class="step-title">
                                    Data Pelapor
                                </div>

                            </div>

                            <div class="step">

                                <div class="step-number">4</div>

                                <div class="step-title">
                                    Konfirmasi
                                </div>

                            </div>

                        </div>

                        <!-- FORM -->
                        <form action="{{ route('pengaduan.storeStep1') }}" method="POST">

                            @csrf

                            <div class="row">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Judul Aduan

                                    </label>

                                    <input type="text" class="form-control" name="judul_aduan"
                                        value="{{ old('judul_aduan', session('pengaduan.step1.judul_aduan')) }}"
                                        placeholder="Masukkan judul aduan">

                                    @error('judul_aduan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="mb-3">

                                    <label class="form-label">

                                        Topik Aduan

                                    </label>

                                    <select class="form-select" name="topik_aduan">

                                        <option value="">-- Pilih Topik --</option>

                                        <option value="Penyalahgunaan Narkotika" {{ session('pengaduan.step1.topik_aduan') == 'Penyalahgunaan Narkotika' ? 'selected' : '' }}>
                                            Penyalahgunaan Narkotika
                                        </option>

                                        <option value="Peredaran Gelap Narkotika" {{ session('pengaduan.step1.topik_aduan') == 'Peredaran Gelap Narkotika' ? 'selected' : '' }}>
                                            Peredaran Gelap Narkotika
                                        </option>

                                        <option value="Pelanggaran Internal" {{ session('pengaduan.step1.topik_aduan') == 'Pelanggaran Internal' ? 'selected' : '' }}>
                                            Pelanggaran Internal
                                        </option>

                                    </select>

                                    @error('topik_aduan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Detail Aduan

                                </label>

                                <textarea name="detail_aduan" rows="6" class="form-control"
                                    placeholder="Jelaskan kronologi kejadian secara lengkap">{{ old('detail_aduan', session('pengaduan.step1.detail_aduan')) }}</textarea>

                                @error('detail_aduan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="form-navigation">

                                <button type="submit" class="btn-next">

                                    Selanjutnya

                                </button>

                            </div>

                        </form>
                        </form>

                    </div>

                </div>

                <!-- ==========================================
                                                                            SIDEBAR
                                                                    =========================================== -->

                <aside class="sidebar-aduan">

                    <div class="sidebar-header">

                        <h5>Aduan Terbaru</h5>

                        <a href="#tracking-section" class="btn-sidebar">

                            <i class="bi bi-search"></i>

                            Lacak Aduan

                        </a>

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