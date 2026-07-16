<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataPermohonanController extends Controller
{
    public function dataPermohonan()
    {
        return view('superadmin.data_permohonan');
    }
}