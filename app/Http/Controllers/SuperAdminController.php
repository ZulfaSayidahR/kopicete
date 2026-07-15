<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard Super Admin
     */
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    /**
     * Menampilkan halaman Data Admin
     */
    public function admin()
    {
        return view('superadmin.admin');
    }

    /**
     * Menampilkan Data Pengaduan
     */
    public function pengaduan()
    {
        return view('superadmin.pengaduan');
    }

    /**
     * Menampilkan Data Permohonan
     */
    public function permohonan()
    {
        return view('superadmin.permohonan');
    }

    /**
     * Menampilkan Log Aktivitas
     */
    public function aktivitas()
    {
        return view('superadmin.aktivitas');
    }

    /**
     * Menampilkan Pengaturan Website
     */
    public function pengaturan()
    {
        return view('superadmin.pengaturan');
    }
}