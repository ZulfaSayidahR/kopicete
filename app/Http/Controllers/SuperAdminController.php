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

    /**
     * Menampilkan halaman Data Admin.
     */
    public function dataAdmin(): View
    {
        // Sesuai nama file: data_admin.blade.php
        return view('superadmin.data_admin');
    }
}