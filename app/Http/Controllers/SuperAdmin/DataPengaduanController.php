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
}