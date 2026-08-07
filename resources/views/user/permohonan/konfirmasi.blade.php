@extends('layouts.app')

@section('title', 'Konfirmasi Permohonan')

@section('content')

<section class="pengaduan-page">
    <div class="container">
        <div class="pengaduan-card">

            <div class="pengaduan-header">
                <h4>Konfirmasi Permohonan</h4>
                <p>
                    Pastikan seluruh data yang telah Anda masukkan sudah benar sebelum mengirim permohonan.
                </p>
            </div>

            <div class="pengaduan-body">

                <table class="table table-borderless">

                    <tr>
                        <td width="35%"><strong>Jenis Permohonan</strong></td>
                        <td>{{ $data['jenis_permohonan'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Nama Penyelenggara</strong></td>
                        <td>{{ $data['nama_penyelenggara'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Tanggal Kegiatan</strong></td>
                        <td>{{ $data['tanggal_kegiatan'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Waktu Kegiatan</strong></td>
                        <td>{{ $data['waktu_kegiatan'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Tempat Penyelenggara</strong></td>
                        <td>{{ $data['tempat'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Nama Penanggung Jawab</strong></td>
                        <td>{{ $data['penanggung_jawab'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>No. HP Penanggung Jawab</strong></td>
                        <td>{{ $data['no_hp'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Jumlah Peserta</strong></td>
                        <td>{{ $data['jumlah_peserta'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Keterangan</strong></td>
                        <td>{{ $data['keterangan'] }}</td>
                    </tr>

                </table>

                <form action="{{ route('permohonan.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    @foreach ($data as $key => $value)
                        @if ($key != '_token')
                            <input
                                type="hidden"
                                name="{{ $key }}"
                                value="{{ $value }}">
                        @endif
                    @endforeach

                    <div class="d-flex justify-content-between mt-4">

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Kirim Permohonan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</section>

@endsection