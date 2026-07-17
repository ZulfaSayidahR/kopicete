<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    public function dashboard()
    {
        return view('adminpengaduan.dashboard');
    }

    public function dataPengaduan()
    {
        return view('adminpengaduan.data_pengaduan');
    }

    public function detailPengaduan()
    {
        return view('adminpengaduan.detail_pengaduan');
    }

    public function updatePengaduan(Request $request)
    {
        return redirect()
            ->route('adminpengaduan.data_pengaduan')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}