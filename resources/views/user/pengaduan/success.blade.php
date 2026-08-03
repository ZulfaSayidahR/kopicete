@extends('layouts.app')

@section('title', 'Pengaduan Berhasil')

@section('content')

    <div class="container mt-5">

        <div class="card text-center p-5">

            <h2 class="text-success">
                Pengaduan Berhasil Dikirim
            </h2>

            <p>
                Terima kasih, laporan Anda sudah masuk ke sistem BNNK Tulungagung.
            </p>

            <h4>
                Kode Pengaduan:
                <b>{{ $kode }}</b>
            </h4>


            <a href="/" class="btn btn-primary mt-3">
                Kembali ke Beranda
            </a>

        </div>

    </div>

@endsection