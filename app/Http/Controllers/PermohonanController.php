<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function create()
    {
        return view('user.permohonan.create');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Permohonan berhasil dikirim.');
    }
}