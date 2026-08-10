@extends('layouts.app')

@section('title', 'Permohonan Berhasil')

@section('content')

    <section class="pengaduan-page">

        <div class="container">

            <div class="pengaduan-card">

                {{-- HEADER --}}
                <div class="pengaduan-header text-center">

                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill" style="font-size: 70px; color: #198754;">
                        </i>
                    </div>

                    <h2>Permohonan Berhasil Dikirim</h2>

                    <p>
                        Terima kasih, permohonan Anda telah berhasil
                        dikirim dan masuk ke sistem BNNK Tulungagung.
                    </p>

                </div>


                {{-- BODY --}}
                <div class="pengaduan-body">

                    <div class="text-center">

                        <p class="text-muted mb-2">
                            Simpan kode permohonan berikut untuk
                            memantau proses permohonan Anda.
                        </p>


                        {{-- KODE PERMOHONAN --}}
                        <div class="border rounded p-4 bg-light mb-4">

                            <small class="text-muted d-block mb-2">
                                KODE PERMOHONAN
                            </small>

                            <h2 class="fw-bold text-primary mb-0">
                                {{ $permohonan->kode_permohonan }}
                            </h2>

                        </div>


                        {{-- INFORMASI --}}
                        <div class="alert alert-info text-start">

                            <i class="bi bi-info-circle-fill me-2"></i>

                            <strong>Informasi:</strong>

                            <p class="mb-0 mt-2">
                                Gunakan kode permohonan tersebut untuk
                                melakukan pelacakan status permohonan.
                                Jangan membagikan kode ini kepada orang lain.
                            </p>

                        </div>


                        {{-- DETAIL SINGKAT --}}
                        <div class="text-start border rounded p-3 mb-4">

                            <div class="row mb-2">

                                <div class="col-md-5">
                                    <strong>Jenis Permohonan</strong>
                                </div>

                                <div class="col-md-7">
                                    {{ $permohonan->jenis_permohonan }}
                                </div>

                            </div>


                            <div class="row mb-2">

                                <div class="col-md-5">
                                    <strong>Nama Penyelenggara</strong>
                                </div>

                                <div class="col-md-7">
                                    {{ $permohonan->nama_penyelenggara }}
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-5">
                                    <strong>Status</strong>
                                </div>

                                <div class="col-md-7">

                                    <span class="badge bg-secondary">
                                        {{ $permohonan->status }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('home') }}" class="btn btn-primary">

                                <i class="bi bi-house-fill me-2"></i>

                                Kembali ke Beranda

                            </a>

                            {{-- Jika route tracking permohonan sudah dibuat --}}
                            @if(Route::has('permohonan.tracking'))

                                <a href="{{ route('permohonan.tracking', $permohonan->kode_permohonan) }}"
                                    class="btn btn-outline-primary">

                                    <i class="bi bi-search me-2"></i>

                                    Lacak Permohonan

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection