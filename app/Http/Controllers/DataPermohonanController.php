<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function dataPermohonan()
    {
        return view('superadmin.data_permohonan');
    }
}