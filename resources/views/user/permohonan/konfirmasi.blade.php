@extends('layouts.app')

@section('title', 'Konfirmasi Permohonan')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="permohonan-wrapper">

                {{-- =====================================================
                KONFIRMASI PERMOHONAN
                ====================================================== --}}

                <div class="pengaduan-card">

                    {{-- HEADER --}}

                    <div class="pengaduan-header">

                        <h4>
                            Konfirmasi Permohonan
                        </h4>

                        <p>
                            Pastikan seluruh data yang telah Anda masukkan
                            sudah benar sebelum mengirim permohonan.
                        </p>

                    </div>


                    {{-- BODY --}}

                    <div class="pengaduan-body">

                        {{-- =====================================================
                        CEK DATA
                        ====================================================== --}}

                        @if(empty($data))

                            <div class="alert alert-danger">

                                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                                Data permohonan tidak ditemukan.

                                <a href="{{ route('permohonan.create') }}" class="ms-1">
                                    Kembali ke formulir
                                </a>

                            </div>

                        @else


                                        {{-- =================================================
                                        INFORMASI JENIS PERMOHONAN
                                        ================================================== --}}

                                        <div class="mb-4">

                                            <div class="alert alert-primary">

                                                <i class="bi bi-file-earmark-text-fill me-2"></i>

                                                <strong>
                                                    {{ $data['jenis_permohonan'] === 'Sosialisasi'
                            ? 'Permohonan Sosialisasi'
                            : 'Permohonan Rehabilitasi'
                                                                                                                                            }}
                                                </strong>

                                            </div>

                                        </div>


                                        {{-- =================================================
                                        DATA PERMOHONAN
                                        ================================================== --}}

                                        <div class="table-responsive">

                                            <table class="table table-borderless align-middle">

                                                {{-- =================================================
                                                JENIS PERMOHONAN
                                                ================================================== --}}

                                                <tr>
                                                    <td width="35%">
                                                        <strong>
                                                            Jenis Permohonan
                                                        </strong>
                                                    </td>

                                                    <td>
                                                        @if($data['jenis_permohonan'] === 'Sosialisasi')
                                                            Permohonan Sosialisasi
                                                        @elseif($data['jenis_permohonan'] === 'Rehabilitasi')
                                                            Permohonan Rehabilitasi
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>

                                                {{-- =================================================
                                                SOSIALISASI
                                                ================================================== --}}

                                                @if($data['jenis_permohonan'] === 'Sosialisasi')


                                                    {{-- NAMA PENYELENGGARA --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Nama Penyelenggara
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['nama_penyelenggara'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- TANGGAL KEGIATAN --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Tanggal Kegiatan
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            @if(!empty($data['tanggal_kegiatan']))

                                                                                        {{ \Carbon\Carbon::parse(
                                                                    $data['tanggal_kegiatan']
                                                                )->translatedFormat('d F Y') }}

                                                            @else

                                                                -

                                                            @endif

                                                        </td>

                                                    </tr>


                                                    {{-- WAKTU KEGIATAN --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Waktu Kegiatan
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['waktu_kegiatan'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- TEMPAT --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Tempat Kegiatan
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['tempat'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- PENANGGUNG JAWAB --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Penanggung Jawab
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['penanggung_jawab'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- JUMLAH PESERTA --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Jumlah Peserta
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['jumlah_peserta'] ?? '-' }}
                                                            orang

                                                        </td>

                                                    </tr>


                                                    {{-- =================================================
                                                    REHABILITASI
                                                    ================================================== --}}

                                                @elseif($data['jenis_permohonan'] === 'Rehabilitasi')


                                                    {{-- NAMA PEMOHON --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Nama Pemohon
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['nama_pemohon'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- NIK --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                NIK
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['nik'] ?? '-' }}

                                                        </td>

                                                    </tr>


                                                    {{-- ALAMAT --}}

                                                    <tr>

                                                        <td>

                                                            <strong>
                                                                Alamat Pemohon
                                                            </strong>

                                                        </td>

                                                        <td>

                                                            {{ $data['alamat_pemohon'] ?? '-' }}

                                                        </td>

                                                    </tr>





                                                @endif


                                                {{-- =================================================
                                                NO WHATSAPP
                                                ================================================== --}}

                                                <tr>

                                                    <td>

                                                        <strong>
                                                            No. WhatsApp
                                                        </strong>

                                                    </td>

                                                    <td>

                                                        {{ $data['no_hp'] ?? '-' }}

                                                    </td>

                                                </tr>


                                                {{-- =================================================
                                                KETERANGAN
                                                ================================================== --}}

                                                <tr>

                                                    <td>

                                                        <strong>
                                                            Keterangan
                                                        </strong>

                                                    </td>

                                                    <td>

                                                        @if(!empty($data['keterangan']))

                                                                                        {!! nl2br(
                                                                e($data['keterangan'])
                                                            ) !!}

                                                        @else

                                                            <span class="text-muted">
                                                                Tidak ada keterangan
                                                            </span>

                                                        @endif

                                                    </td>

                                                </tr>


                                                {{-- =================================================
                                                LAMPIRAN
                                                ================================================== --}}

                                                <tr>

                                                    <td>

                                                        <strong>
                                                            Lampiran
                                                        </strong>

                                                    </td>

                                                    <td>

                                                        @if(!empty($data['lampiran']))

                                                            <a href="{{ asset('storage/' . $data['lampiran']) }}" target="_blank"
                                                                class="btn btn-sm btn-outline-primary">

                                                                <i class="bi bi-file-earmark-text me-1"></i>

                                                                Lihat Lampiran

                                                            </a>

                                                        @else

                                                            <span class="text-muted">

                                                                Tidak ada lampiran

                                                            </span>

                                                        @endif

                                                    </td>

                                                </tr>

                                            </table>

                                        </div>


                                        {{-- =====================================================
                                        PERINGATAN
                                        ====================================================== --}}

                                        <div class="alert alert-warning mt-4">

                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                                            <strong>
                                                Periksa kembali data Anda.
                                            </strong>

                                            Pastikan seluruh informasi sudah benar sebelum
                                            melanjutkan ke verifikasi OTP.

                                        </div>




                                        {{-- =====================================================
                                        INFORMASI OTP
                                        ====================================================== --}}

                                        <div class="alert alert-info">

                                            <i class="bi bi-whatsapp me-2"></i>

                                            Setelah menekan tombol
                                            <strong>Kirim Permohonan</strong>,
                                            sistem akan mengirimkan kode OTP ke nomor WhatsApp:

                                            <strong>
                                                {{ $data['no_hp'] ?? '-' }}
                                            </strong>

                                        </div>


                                        <!-- CHAPTAAAAAAAAAAAAAAAAA -->

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



                                        {{-- =====================================================
                                        NAVIGASI
                                        ====================================================== --}}

                                        <div class="form-navigation mt-4">

                                            {{-- KEMBALI --}}

                                            <a href="{{ route('permohonan.create') }}" class="btn-prev">

                                                Kembali

                                            </a>


                                            {{-- =================================================
                                            KIRIM OTP
                                            ================================================== --}}

                                            <form action="{{ route('permohonan.kirim') }}" method="POST" class="d-inline">

                                                @csrf

                                                <button type="submit" class="btn-next">

                                                    Kirim Permohonan

                                                </button>

                                            </form>

                                        </div>


                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection