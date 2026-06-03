<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminRantingController extends Controller
{
    public function dashboard()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R03') return redirect('/dashboard');

        return view('admin_ranting.dashboard');
    }
}
