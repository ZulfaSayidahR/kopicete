<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class HomeController extends Controller
{
    public function index()
    {
        $totalAduan = Pengaduan::count();

        $totalPermohonan = 0; // sementara jika tabel permohonan belum ada


        return view('user.home', compact(
            'totalAduan',
            'totalPermohonan'
        ));
    }
}