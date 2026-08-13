<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Permohonan;

class HomeController extends Controller
{
    public function index()
    {
        $totalAduan = Pengaduan::count();

        $totalPermohonan = Permohonan::count();


        return view('user.home', compact(
            'totalAduan',
            'totalPermohonan'
        ));
    }
}