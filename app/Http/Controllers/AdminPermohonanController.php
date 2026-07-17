<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPermohonanController extends Controller
{
    public function dashboard()
    {
        return view('adminpermohonan.dashboard');
    }

    public function dataPermohonan()
    {
        return view('adminpermohonan.data_permohonan');
    }

    public function detailPermohonan()
    {
        return view('adminpermohonan.detail_permohonan');
    }

    public function updatePermohonan(Request $request)
    {
        return redirect()
            ->route('adminpermohonan.data_permohonan')
            ->with('success','Status berhasil diperbarui');
    }
}
