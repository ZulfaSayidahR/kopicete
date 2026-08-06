<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [

        'kode_aduan',
        'judul_aduan',
        'topik_aduan',
        'detail_aduan',
        'id_kecamatan',
        'id_desa',
        'lampiran',
        'nama_lengkap',
        'no_whatsapp',
        'email',
        'alamat_domisili',
        'otp_verified_at',
        'status',

        // tracking
        'tanggal_verifikasi',
        'tanggal_proses',
        'tanggal_selesai',
        'catatan_admin',
        'foto_tindak_lanjut',

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