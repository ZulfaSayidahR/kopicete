<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function create()
    {
        return view('user.permohonan.create');
    }

        public function konfirmasi(Request $request)
    {
        return view('user.permohonan.konfirmasi', [
            'data' => $request->all()
        ]);
    }

    // Menyimpan data permohonan ke database
    public function store(Request $request)
    {
        $request->validate([
            'jenis_permohonan'    => 'required',
            'nama_penyelenggara'  => 'required',
            'tanggal_kegiatan'    => 'required|date',
            'waktu_kegiatan'      => 'required',
            'tempat'              => 'required',
            'penanggung_jawab'    => 'required',
            'no_hp'               => 'required',
            'jumlah_peserta'      => 'required|integer',
            'keterangan'          => 'nullable',
            'lampiran'            => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $lampiran = null;

        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran')
                ->store('lampiran_permohonan', 'public');
        }

        $permohonan = Permohonan::create([
            'jenis_permohonan'   => $request->jenis_permohonan,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'tanggal_kegiatan'   => $request->tanggal_kegiatan,
            'waktu_kegiatan'     => $request->waktu_kegiatan,
            'tempat'             => $request->tempat,
            'penanggung_jawab'   => $request->penanggung_jawab,
            'no_hp'              => $request->no_hp,
            'jumlah_peserta'     => $request->jumlah_peserta,
            'keterangan'         => $request->keterangan,
            'lampiran'           => $lampiran,
        ]);

        return redirect()->route('permohonan.detail', $permohonan->id)
                         ->with('success', 'Permohonan berhasil dikirim.');
    }

    // public function store(Request $request)
    // {
    //     return back()->with('success', 'Permohonan berhasil dikirim.');
    // }
}