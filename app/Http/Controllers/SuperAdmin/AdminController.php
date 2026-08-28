<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * ============================================================
     * MENAMPILKAN DAFTAR ADMIN
     * ============================================================
     */
    public function index(Request $request)
    {
        $query = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ]);


        // ========================================================
        // SEARCH
        // ========================================================

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )

                    ->orWhere(
                        'email',
                        'like',
                        '%' . $search . '%'
                    );

            });
        }


        // ========================================================
        // PAGINATION
        // ========================================================

        $admins = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        // ========================================================
        // TOTAL ADMIN TERDAFTAR
        // ========================================================

        $totalAdmin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->count();


        // ========================================================
        // VIEW
        // ========================================================

        return view(
            'superadmin.data_admin',
            compact(
                'admins',
                'totalAdmin'
            )
        );
    }


    /**
     * ============================================================
     * MENAMBAHKAN ADMIN BARU
     * ============================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                'in:admin_pengaduan,admin_permohonan',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [

            'name.required' =>
                'Nama wajib diisi.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email tersebut sudah terdaftar.',

            'role.required' =>
                'Silakan pilih role admin.',

            'role.in' =>
                'Role admin tidak valid.',

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sama.',

        ]);


        // ========================================================
        // BUAT ADMIN
        // ========================================================

        User::create([

            'name' =>
                $validated['name'],

            'email' =>
                $validated['email'],

            'password' =>
                Hash::make(
                    $validated['password']
                ),

            'role' =>
                $validated['role'],

            'is_active' =>
                true,

        ]);


        return redirect()
            ->route(
                'superadmin.data_admin'
            )
            ->with(
                'success',
                'Admin berhasil ditambahkan.'
            );
    }


    /**
     * ============================================================
     * RESET PASSWORD ADMIN
     * ============================================================
     */
    public function resetPassword(
        Request $request,
        $id
    ) {

        // ========================================================
        // VALIDASI PASSWORD BARU
        // ========================================================

        $validated = $request->validate([

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [

            'password.required' =>
                'Password wajib diisi.',

            'password.min' =>
                'Password minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak sama.',

        ]);


        // ========================================================
        // CARI ADMIN
        // HANYA ADMIN PENGADUAN / PERMOHONAN
        // ========================================================

        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);


        // ========================================================
        // UPDATE PASSWORD
        // ========================================================

        $admin->password = Hash::make(
            $validated['password']
        );

        $admin->save();


        // ========================================================
        // REDIRECT
        // ========================================================

        return redirect()
            ->route(
                'superadmin.data_admin'
            )
            ->with(
                'success',
                'Password admin berhasil direset.'
            );
    }


    /**
     * ============================================================
     * HAPUS ADMIN
     * ============================================================
     */
    public function destroy($id)
    {
        // ========================================================
        // CARI ADMIN
        // ========================================================

        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);


        // ========================================================
        // HAPUS ADMIN
        // ========================================================

        $admin->delete();


        // ========================================================
        // REDIRECT
        // ========================================================

        return redirect()
            ->route(
                'superadmin.data_admin'
            )
            ->with(
                'success',
                'Admin berhasil dihapus.'
            );
    }


    /**
     * ============================================================
     * AKTIFKAN / NONAKTIFKAN ADMIN
     * ============================================================
     */
    public function toggleStatus($id)
    {
        // ========================================================
        // CARI ADMIN
        // ========================================================

        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);


        // ========================================================
        // UBAH STATUS
        // ========================================================

        $admin->update([

            'is_active' =>
                !$admin->is_active,

        ]);


        // ========================================================
        // PESAN
        // ========================================================

        return redirect()
            ->route(
                'superadmin.data_admin'
            )
            ->with(
                'success',

                $admin->is_active
                ? 'Admin berhasil diaktifkan.'
                : 'Admin berhasil dinonaktifkan.'
            );
    }
}
