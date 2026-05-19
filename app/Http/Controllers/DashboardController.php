<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil jumlah user
        $total_user = DB::table('user')->count();

        // 2. Ambil jumlah cabang (pakai nama kolom 'status_keaktifan')
        $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();

        // 3. Ambil jumlah ranting (pakai nama kolom 'status_keaktifan' juga)
        $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();

        // 4. Ambil jumlah masjid
        $total_masjid = DB::table('masjid')->count();
        $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

        return view('superadmin.dashboard', compact(
            'total_user',
            'total_cabang',
            'total_ranting',
            'total_masjid',
            'masjid_terdaftar'
        ));
    }
}
