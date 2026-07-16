<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPermohonanController extends Controller
{
    // Halaman tabel
    public function dataPermohonan()
    {
        return view('superadmin.data_permohonan');
    }

    // Halaman detail
    public function detailPermohonan()
    {
        return view('superadmin.detail_permohonan');
    }

    // Tombol Simpan
    public function updatePermohonan(Request $request)
    {
        return redirect()
            ->route('superadmin.data_permohonan')
            ->with('success', 'Status permohonan berhasil diperbarui.');
    }
}