<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    public function dashboard()
    {
        return view('admin_pengaduan.dashboard');
    }

    public function dataPengaduan()
    {
        return view('admin_pengaduan.data_pengaduan');
    }

    public function detailPengaduan()
    {
        return view('admin_pengaduan.detail_pengaduan');
    }

    public function updatePengaduan(Request $request)
    {
        return redirect()
            ->route('adminpengaduan.data_pengaduan')
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}