<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;

class AdminPermohonanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalPermohonan = Permohonan::count();

        $diverifikasi = Permohonan::where(
            'status',
            'Diverifikasi'
        )->count();

        $diproses = Permohonan::where(
            'status',
            'Diproses'
        )->count();

        $selesai = Permohonan::where(
            'status',
            'Selesai'
        )->count();

        $permohonans = Permohonan::latest()
            ->paginate(10);

        return view(
            'adminpermohonan.dashboard',
            compact(
                'totalPermohonan',
                'diverifikasi',
                'diproses',
                'selesai',
                'permohonans'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DATA PERMOHONAN
    |--------------------------------------------------------------------------
    */

    public function dataPermohonan()
    {
        $permohonans = \App\Models\Permohonan::latest()
            ->paginate(10);

        return view(
            'adminpermohonan.data_permohonan',
            compact('permohonans')
        );
    }



    /*
    |--------------------------------------------------------------------------
    | DETAIL PERMOHONAN
    |--------------------------------------------------------------------------
    */

    public function detailPermohonan($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        return view(
            'adminpermohonan.detail_permohonan',
            compact('permohonan')
        );
    }

    /*
|--------------------------------------------------------------------------
| UPDATE PERMOHONAN
|--------------------------------------------------------------------------
*/

    public function updatePermohonan(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'status' => 'required|in:Diverifikasi,Diproses,Selesai,Ditolak',

            'catatan' => 'nullable|string',

            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PERMOHONAN
        |--------------------------------------------------------------------------
        */

        $permohonan = Permohonan::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | DATA DASAR
        |--------------------------------------------------------------------------
        */

        $data = [
            'status' => $request->status,
        ];


        /*
        |--------------------------------------------------------------------------
        | DIVERIFIKASI
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'Diverifikasi') {

            $data['tanggal_verifikasi'] = now();

            $data['catatan_verifikasi'] = $request->catatan;


            /*
            |----------------------------------------------------------------------
            | SIMPAN FILE VERIFIKASI
            |----------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $data['file_verifikasi'] = $request
                    ->file('bukti')
                    ->store('permohonan/verifikasi', 'public');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DIPROSES
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Diproses') {

            $data['tanggal_proses'] = now();

            $data['catatan_proses'] = $request->catatan;


            /*
            |----------------------------------------------------------------------
            | SIMPAN FILE PROSES
            |----------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $data['file_proses'] = $request
                    ->file('bukti')
                    ->store('permohonan/proses', 'public');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Selesai') {

            $data['tanggal_selesai'] = now();

            $data['catatan_selesai'] = $request->catatan;


            /*
            |----------------------------------------------------------------------
            | SIMPAN FILE SELESAI
            |----------------------------------------------------------------------
            */

            if ($request->hasFile('bukti')) {

                $data['file_selesai'] = $request
                    ->file('bukti')
                    ->store('permohonan/selesai', 'public');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DITOLAK
        |--------------------------------------------------------------------------
        */ elseif ($request->status === 'Ditolak') {

            $data['tanggal_verifikasi'] = now();

            $data['catatan_verifikasi'] = $request->catatan;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $permohonan->update($data);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'adminpermohonan.detail_permohonan',
                $permohonan->id
            )
            ->with(
                'success',
                'Data permohonan berhasil diperbarui.'
            );
    }
    /*
|--------------------------------------------------------------------------
| HAPUS PERMOHONAN
|--------------------------------------------------------------------------
*/

    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);

        $permohonan->delete();

        return redirect()
            ->route('adminpermohonan.data_permohonan')
            ->with(
                'success',
                'Data permohonan berhasil dihapus.'
            );
    }
}