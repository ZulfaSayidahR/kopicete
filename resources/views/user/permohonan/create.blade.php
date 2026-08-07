@extends('layouts.app')

@section('title', 'Portal Permohonan')

@section('content')

<section class="pengaduan-page">
    <div class="container">
        <div class="permohonan-wrapper">

            <div class="pengaduan-card">

                <div class="pengaduan-header">
                    <h4>Form Permohonan</h4>
                    <p>
                        Sampaikan permohonan kegiatan kepada BNNK Tulungagung
                        dengan melengkapi seluruh data berikut.
                    </p>
                </div>

                <div class="pengaduan-body">

                    <form action="{{ route('permohonan.konfirmasi') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <!-- Jenis Permohonan -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis Permohonan</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <select class="form-select" name="jenis_permohonan" required>
                                    <option value="" selected disabled>
                                        Pilih Jenis Permohonan
                                    </option>

                                    <option value="Permohonan Sosialisasi">
                                        Permohonan Sosialisasi
                                    </option>

                                    <option value="Permohonan Rehabilitasi">
                                        Permohonan Rehabilitasi
                                    </option>
                                </select>
                            </div>

                            <!-- Nama Penyelenggara -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Penyelenggara</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama_penyelenggara"
                                    placeholder="Masukkan nama penyelenggara"
                                    required>
                            </div>

                            <!-- Tanggal -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tanggal Kegiatan</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="date"
                                    class="form-control"
                                    name="tanggal_kegiatan"
                                    required>
                            </div>

                            <!-- Waktu -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Waktu Kegiatan</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="time"
                                    class="form-control"
                                    name="waktu_kegiatan"
                                    required>
                            </div>

                            <!-- Tempat -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tempat Penyelenggara</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="tempat"
                                    placeholder="Masukkan lokasi kegiatan"
                                    required>
                            </div>

                            <!-- Penanggung Jawab -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Penanggung Jawab</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="penanggung_jawab"
                                    placeholder="Nama penanggung jawab"
                                    required>
                            </div>

                            <!-- No HP -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">No HP Penanggung Jawab</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="no_hp"
                                    placeholder="08xxxxxxxxxx"
                                    required>
                            </div>

                            <!-- Jumlah Peserta -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah Peserta</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    name="jumlah_peserta"
                                    placeholder="Jumlah peserta"
                                    required>
                            </div>

                            <!-- Keterangan -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Keterangan</label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <textarea
                                    class="form-control"
                                    name="keterangan"
                                    rows="5"
                                    placeholder="Tuliskan keterangan kegiatan"></textarea>
                            </div>

                            <!-- Lampiran -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">
                                    Lampiran Surat Undangan
                                </label>
                            </div>

                            <div class="col-md-8 mb-3">
                                <input
                                    type="file"
                                    class="form-control"
                                    name="lampiran"
                                    accept=".pdf,.jpg,.jpeg,.png">

                                <div class="form-note">
                                    Format PDF / JPG / PNG maksimal 5 MB.
                                </div>
                            </div>

                        </div>

                        <div class="form-navigation">

                            <a href="{{ route('home') }}" class="btn-prev">
                                Sebelumnya
                            </a>

                            <button type="submit" class="btn-next">
                                Selanjutnya
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</section>

@endsection