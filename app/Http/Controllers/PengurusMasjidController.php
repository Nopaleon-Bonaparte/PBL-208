<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengurusMasjidController extends Controller
{
    public function dashboard()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R02') return redirect('/dashboard');

        return view('pengurus_masjid.dashboard');
    }
}
