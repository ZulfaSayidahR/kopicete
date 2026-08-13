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

            {{-- =====================================================
                SIDEBAR PERMOHONAN TERBARU
                ====================================================== --}}

                <aside class="sidebar-aduan">

                    <div class="aduan-terbaru-header">

                        <h4>Permohonan Terbaru</h4>

                    </div>

                    {{-- SEARCH PERMOHONAN --}}
                    <div class="search-permohonan-box">

                        <form action="{{ route('permohonan.cari') }}" method="GET">

                            <div class="search-permohonan-wrapper">

                                <div class="search-permohonan-input-wrapper">

                                    <i class="bi bi-search"></i>

                                    <input
                                        type="text"
                                        name="jenis_permohonan"
                                        value="{{ request('jenis_permohonan') }}"
                                        placeholder="Cari berdasarkan jenis permohonan..."
                                        autocomplete="off"
                                    >

                                </div>

                                <button type="submit" class="btn-search-permohonan">

                                    <i class="bi bi-search"></i>

                                    Cari

                                </button>

                            </div>

                        </form>

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