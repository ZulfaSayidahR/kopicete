@extends('layouts.app')

@section('title', 'Portal Permohonan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="permohonan-wrapper">

                {{-- =====================================================
                FORM PERMOHONAN
                ====================================================== --}}

                <div class="pengaduan-card">

                    <div class="pengaduan-header">

                        <h4>Form Permohonan</h4>

                        <p>
                            Sampaikan permohonan kegiatan kepada BNNK Tulungagung
                            dengan melengkapi seluruh data berikut.
                        </p>

                    </div>


                    <div class="pengaduan-body">

                        <form action="{{ route('permohonan.konfirmasi') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                {{-- JENIS PERMOHONAN --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jenis Permohonan
                                    </label>

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


                                {{-- NAMA PENYELENGGARA --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penyelenggara
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" name="nama_penyelenggara"
                                        placeholder="Masukkan nama penyelenggara" value="{{ old('nama_penyelenggara') }}"
                                        required>

                                </div>


                                {{-- TANGGAL --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tanggal Kegiatan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="date" class="form-control" name="tanggal_kegiatan"
                                        value="{{ old('tanggal_kegiatan') }}" required>

                                </div>


                                {{-- WAKTU --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Waktu Kegiatan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="time" class="form-control" name="waktu_kegiatan"
                                        value="{{ old('waktu_kegiatan') }}" required>

                                </div>


                                {{-- TEMPAT --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tempat Penyelenggara
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" name="tempat"
                                        placeholder="Masukkan lokasi kegiatan" value="{{ old('tempat') }}" required>

                                </div>


                                {{-- PENANGGUNG JAWAB --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Nama Penanggung Jawab
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" name="penanggung_jawab"
                                        placeholder="Nama penanggung jawab" value="{{ old('penanggung_jawab') }}" required>

                                </div>


                                {{-- NO HP --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        No HP Penanggung Jawab
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="text" class="form-control" name="no_hp" placeholder="08xxxxxxxxxx"
                                        value="{{ old('no_hp') }}" required>

                                </div>


                                {{-- JUMLAH PESERTA --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jumlah Peserta
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="number" class="form-control" name="jumlah_peserta"
                                        placeholder="Jumlah peserta" value="{{ old('jumlah_peserta') }}" min="1" required>

                                </div>


                                {{-- KETERANGAN --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Keterangan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <textarea class="form-control" name="keterangan" rows="5"
                                        placeholder="Tuliskan keterangan kegiatan">{{ old('keterangan') }}</textarea>

                                </div>


                                {{-- LAMPIRAN --}}
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Lampiran Surat Undangan
                                    </label>

                                </div>

                                <div class="col-md-8 mb-3">

                                    <input type="file" class="form-control" name="lampiran" accept=".pdf,.jpg,.jpeg,.png">

                                    <div class="form-note">

                                        Format PDF / JPG / PNG maksimal 5 MB.

                                    </div>

                                </div>

                            </div>


                            {{-- NAVIGASI --}}
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


                {{-- =====================================================
                SIDEBAR PERMOHONAN TERBARU
                ====================================================== --}}

                <aside class="sidebar-aduan">

                    <div class="sidebar-header">

                        <h5>
                            Permohonan Terbaru
                        </h5>

                        <a href="#tracking-section" class="btn-sidebar">

                            <i class="bi bi-search"></i>

                            Lacak Permohonan

                        </a>

                    </div>


                    {{-- DATA PERMOHONAN --}}
                    @forelse($permohonanTerbaru as $item)

                                    <div class="aduan-item">

                                        {{-- STATUS --}}
                                        <span class="status
                                                @if($item->status == 'Menunggu')
                                                    menunggu
                                                @elseif($item->status == 'Diproses')
                                                    proses
                                                @elseif($item->status == 'Selesai')
                                                    selesai
                                                @elseif($item->status == 'Ditolak')
                                                    ditolak
                                                @else
                                                    verifikasi
                                                @endif">

                                            {{ $item->status }}

                                        </span>


                                        {{-- JENIS PERMOHONAN --}}
                                        <h6>

                                            {{ \Illuminate\Support\Str::limit(
                            $item->jenis_permohonan,
                            40
                        ) }}

                                        </h6>


                                        {{-- PENYELENGGARA --}}
                                        <small>

                                            <i class="bi bi-person-fill"></i>

                                            {{ \Illuminate\Support\Str::limit(
                            $item->nama_penyelenggara,
                            30
                        ) }}

                                        </small>


                                        {{-- TANGGAL --}}
                                        <small>

                                            <i class="bi bi-calendar-event-fill"></i>

                                            {{ $item->created_at->translatedFormat('d F Y') }}

                                        </small>


                                        {{-- TRACKING --}}
                                        <a href="{{ route(
                            'permohonan.tracking',
                            $item->kode_permohonan
                        ) }}" class="btn-detail-laporan">

                                            <i class="bi bi-eye-fill"></i>

                                            Lihat Tracking

                                        </a>

                                    </div>

                    @empty

                        <div class="alert alert-light">

                            <i class="bi bi-info-circle me-1"></i>

                            Belum ada permohonan.

                        </div>

                    @endforelse

                </aside>

            </div>

        </div>

    </section>

@endsection