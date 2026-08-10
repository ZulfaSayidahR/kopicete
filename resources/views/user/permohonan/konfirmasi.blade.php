@extends('layouts.app')

@section('title', 'Konfirmasi Permohonan')

@section('content')

<section class="pengaduan-page">
    <div class="container">
        <div class="permohonan-wrapper">

            <div class="pengaduan-card">

                {{-- HEADER --}}
                <div class="pengaduan-header">

                    <h4>Konfirmasi Permohonan</h4>

                    <p>
                        Pastikan seluruh data yang telah Anda masukkan sudah benar
                        sebelum mengirim permohonan.
                    </p>

                </div>


                {{-- BODY --}}
                <div class="pengaduan-body">

                    {{-- CEK DATA --}}
                    @if(empty($data))

                        <div class="alert alert-danger">

                            Data permohonan tidak ditemukan.

                            <a href="{{ route('permohonan.create') }}">
                                Kembali ke formulir
                            </a>

                        </div>

                    @else

                        {{-- INFORMASI PERMOHONAN --}}
                        <table class="table table-borderless">

                            <tr>

                                <td width="35%">
                                    <strong>Jenis Permohonan</strong>
                                </td>

                                <td>
                                    {{ $data['jenis_permohonan'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Nama Penyelenggara</strong>
                                </td>

                                <td>
                                    {{ $data['nama_penyelenggara'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Tanggal Kegiatan</strong>
                                </td>

                                <td>
                                    {{ !empty($data['tanggal_kegiatan'])
                        ? \Carbon\Carbon::parse($data['tanggal_kegiatan'])->translatedFormat('d F Y')
                        : '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Waktu Kegiatan</strong>
                                </td>

                                <td>
                                    {{ $data['waktu_kegiatan'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Tempat Penyelenggara</strong>
                                </td>

                                <td>
                                    {{ $data['tempat'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Nama Penanggung Jawab</strong>
                                </td>

                                <td>
                                    {{ $data['penanggung_jawab'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>No. HP Penanggung Jawab</strong>
                                </td>

                                <td>
                                    {{ $data['no_hp'] ?? '-' }}
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Jumlah Peserta</strong>
                                </td>

                                <td>
                                    {{ $data['jumlah_peserta'] ?? '-' }} orang
                                </td>

                            </tr>


                            <tr>

                                <td>
                                    <strong>Keterangan</strong>
                                </td>

                                <td>
                                    {{ $data['keterangan'] ?? '-' }}
                                </td>

                            </tr>


                            {{-- LAMPIRAN --}}
                            <tr>

                                <td>
                                    <strong>Lampiran</strong>
                                </td>

                                <td>

                                    @if(!empty($data['lampiran']))

                                        <a href="{{ asset('storage/' . $data['lampiran']) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-file-earmark-text"></i>

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


                        {{-- PERINGATAN --}}
                        <div class="alert alert-warning mt-4">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            <strong>Periksa kembali data Anda.</strong>

                            Pastikan seluruh informasi sudah benar sebelum
                            melanjutkan ke proses verifikasi OTP.

                        </div>


                        {{-- NAVIGASI --}}
                        <div class="form-navigation mt-4">

                            <a href="{{ route('permohonan.create') }}" class="btn-prev">

                                <i class="bi bi-arrow-left"></i>

                                Kembali

                            </a>


                            {{-- Lanjut ke OTP --}}
                            <a href="{{ route('permohonan.otp') }}" class="btn-next">

                                Kirim Permohonan

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
</section>

@endsection