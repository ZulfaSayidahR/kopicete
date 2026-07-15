<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SuperAdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard Super Admin.
     */
    public function dashboard(): View
    {
        return view('superadmin.dashboard');
    }
    public function data_pengaduan()
    {
        return view('superadmin.data_pengaduan');
    }
    /**
     * Menampilkan halaman Data Admin.
     */
    public function dataAdmin(): View
    {
        // Sesuai nama file: data_admin.blade.php
        return view('superadmin.data_admin');
    }
}