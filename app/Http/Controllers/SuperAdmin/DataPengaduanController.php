<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPengaduanController extends Controller
{
    public function dataPengaduan()
    {
        return view('superadmin.data_pengaduan');
    }

    public function detailPengaduan()
    {
        return view('superadmin.detail_pengaduan');
    }

    public function updateStatus(Request $request)
    {
        // Karena belum memakai database,
        // hanya redirect dengan pesan berhasil.

        return redirect()
            ->route('superadmin.data_pengaduan')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}