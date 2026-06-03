<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminCabangController extends Controller
{
    public function dashboard()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R01') return redirect('/dashboard');

        return view('admin_cabang.dashboard');
    }
}
