<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;


    // Nama tabel di database
    protected $table = 'desa';


    // Primary key tabel desa
    protected $primaryKey = 'id_desa';


    // Jika tidak memakai created_at dan updated_at
    public $timestamps = false;


    // Kolom yang boleh diisi
    protected $fillable = [
        'id_kecamatan',
        'nama_desa'
    ];



    /*
    |--------------------------------------------------------------------------
    | Relasi ke Kecamatan
    |--------------------------------------------------------------------------
    |
    | Satu desa berada di satu kecamatan
    |
    */

    public function kecamatan()
    {
        return $this->belongsTo(
            Kecamatan::class,
            'id_kecamatan',
            'id_kecamatan'
        );
    }


}