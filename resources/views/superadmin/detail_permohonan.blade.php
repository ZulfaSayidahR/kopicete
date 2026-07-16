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
                                    <p>PMH-001</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Jenis Permohonan</strong>
                                    <p>Permohonan Rehabilitasi</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Nama Pemohon</strong>
                                    <p>Ahmad Fauzi</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>No. Telepon</strong>
                                    <p>085612345678</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Email</strong>
                                    <p>ahmad@gmail.com</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>Tanggal Permohonan</strong>
                                    <p>16 Juli 2026</p>
                                </div>

                            </div>

                            <hr>

                            <strong>Tujuan Permohonan</strong>

                            <p>

                                Pemohon mengajukan permohonan rehabilitasi bagi anggota keluarga
                                yang diduga mengalami ketergantungan narkotika agar mendapatkan
                                penanganan dan pendampingan dari BNNK Tulungagung.

                            </p>

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
                            <h3>Riwayat Status</h3>
                        </div>

                        <div class="p-4">

                            <div class="status-timeline">

                                <div class="timeline-item active">

                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">

                                        <h6>Permohonan Diajukan</h6>

                                        <small>16 Jul 2026 - 09:30 WIB</small>

                                    </div>

                                </div>

                                <div class="timeline-item active">

                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">

                                        <h6>Diverifikasi Admin BNNK</h6>

                                        <small>16 Jul 2026 - 10:45 WIB</small>

                                    </div>

                                </div>

                                <div class="timeline-item">

                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">

                                        <h6>Diproses Bidang Rehabilitasi</h6>

                                        <small>Menunggu</small>

                                    </div>

                                </div>

                                <div class="timeline-item">

                                    <div class="timeline-dot"></div>

                                    <div class="timeline-content">

                                        <h6>Permohonan Selesai</h6>

                                        <small>Menunggu</small>

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

                            <form action="{{ route('superadmin.detail_permohonan.update') }}" method="POST">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">

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

                                <div class="mb-3">

                                    <label class="form-label">

                                        Catatan Admin

                                    </label>

                                    <textarea class="form-control" rows="4" name="catatan"
                                        placeholder="Masukkan catatan verifikasi..."></textarea>

                                </div>

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

@endsection