<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(10);

        return view('superadmin.data_admin', compact('admins'));
    }
}