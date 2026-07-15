<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPengaduanController extends Controller
{
    public function dataPengaduan()
    {
        return view('superadmin.data_pengaduan');
    }
}