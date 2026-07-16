<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class PermohonanController extends Controller
{
    public function dataPermohonan()
    {
        return view('superadmin.data_permohonan');
    }
}