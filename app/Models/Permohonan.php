<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $fillable = [

        'kode_permohonan',

        'jenis_permohonan',

        'nama_penyelenggara',

        'tanggal_kegiatan',

        'waktu_kegiatan',

        'tempat',

        'penanggung_jawab',

        'no_hp',

        'jumlah_peserta',

        'keterangan',

        'lampiran',

        'status',

    ];
}