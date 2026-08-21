<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;
use App\Models\Desa;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonans';

    protected $fillable = [

        // IDENTITAS PERMOHONAN
        'kode_permohonan',
        'jenis_permohonan',

        // SOSIALISASI
        'nama_penyelenggara',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'tempat',
        'penanggung_jawab',
        'no_hp',
        'jumlah_peserta',

        // REHABILITASI
        'nama_pemohon',
        'nik',
        'alamat_pemohon',
        'jenis_rehabilitasi',

        // UMUM
        'keterangan',
        'lampiran',

        // STATUS
        'status',

        // TRACKING
        'tanggal_verifikasi',
        'catatan_verifikasi',
        'file_verifikasi',

        'tanggal_proses',
        'catatan_proses',
        'file_proses',

        'tanggal_selesai',
        'catatan_selesai',
        'file_selesai',
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