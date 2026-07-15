@extends('layouts.app')

@section('title', 'Portal Permohonan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="permohonan-wrapper">

                <!-- ================================================= -->
                <!-- FORM -->
                <!-- ================================================= -->

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Permohonan</h4>

                        <p>
                            Sampaikan permohonan kegiatan kepada BNNK Tulungagung
                            dengan melengkapi seluruh data berikut.
                        </p>

                    </div>

                    <div class="pengaduan-body">

                        <form action="#" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        Jenis Permohonan
                                    </label>
                                </div>

                                <div class="col-md-8 mb-3">

                                    <select class="form-select">

                                        <option selected disabled>
                                            Pilih Jenis Permohonan
                                        </option>

                                        <option>Permohonan Sosialisasi</option>

                                        <option>Permohonan Rehabilitasi</option>


                                    </select>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penyelenggara
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" placeholder="Masukkan nama penyelenggara">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tanggal Kegiatan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="date" class="form-control">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Waktu Kegiatan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="time" class="form-control">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tempat Penyelenggara
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" placeholder="Masukkan lokasi kegiatan">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penanggung Jawab
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" placeholder="Nama penanggung jawab">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        No HP Penanggung Jawab
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" placeholder="08xxxxxxxxxx">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jumlah Peserta
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="number" class="form-control" placeholder="Jumlah peserta">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Keterangan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <textarea class="form-control" rows="5"
                                        placeholder="Tuliskan keterangan kegiatan"></textarea>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">

                                        Lampiran Surat Undangan

                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="file" class="form-control">

                                    <div class="form-note">

                                        Format PDF / JPG / PNG maksimal 5 MB.

                                    </div>

                                </div>

                            </div>

                            <div class="form-navigation">

                                <a href="{{ route('home') }}" class="btn-prev">

                                    Sebelumnya

                                </a>

                                <button class="btn-next">

                                    Kirim Permohonan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection