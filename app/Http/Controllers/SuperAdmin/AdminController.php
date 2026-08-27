<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar admin
     */
    public function index(Request $request)
    {
        $query = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ]);

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // PAGINATION
        $admins = $query
            ->latest()
            ->paginate(10);



        return view('superadmin.data_admin', compact('admins'));
    }


    /**
     * Menambahkan admin baru
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
            'name.required' => 'Nama wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah terdaftar.',

            'role.required' => 'Silakan pilih role admin.',
            'role.in' => 'Role admin tidak valid.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('superadmin.data_admin')
            ->with('success', 'Admin berhasil ditambahkan.');
    }


    /**
     * Reset password admin
     */
    public function resetPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('superadmin.data_admin')
            ->with('success', 'Password admin berhasil direset.');
    }


    /**
     * Hapus admin
     */
    public function destroy($id)
    {
        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);

        $admin->delete();

        return redirect()
            ->route('superadmin.data_admin')
            ->with('success', 'Admin berhasil dihapus.');
    }


    /**
     * Aktifkan / nonaktifkan admin
     */
    public function toggleStatus($id)
    {
        $admin = User::whereIn('role', [
            'admin_pengaduan',
            'admin_permohonan',
        ])->findOrFail($id);

        $admin->update([
            'is_active' => !$admin->is_active,
        ]);

        return redirect()
            ->route('superadmin.data_admin')
            ->with(
                'success',
                $admin->is_active
                ? 'Admin berhasil diaktifkan.'
                : 'Admin berhasil dinonaktifkan.'
            );
    }
}