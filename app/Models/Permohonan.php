<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonans';

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

        // TRACKING
        'tanggal_verifikasi',
        'catatan_verifikasi',

        'tanggal_proses',
        'catatan_proses',

        'tanggal_selesai',
        'catatan_selesai',
    ];

    protected $casts = [

        'tanggal_kegiatan' => 'date',

        'tanggal_verifikasi' => 'datetime',

        'tanggal_proses' => 'datetime',

        'tanggal_selesai' => 'datetime',

    ];

    public function kecamatan()
    {
        return $this->belongsTo(
            Kecamatan::class,
            'id_kecamatan',
            'id_kecamatan'
        );
    }

     public function desa()
    {
        return $this->belongsTo(
            Desa::class,
            'id_desa',
            'id_desa'
        );
    }
}