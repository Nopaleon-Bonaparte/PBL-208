<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperadminController extends Controller
{
    // Logika Dashboard
    public function index()
    {
        if (!session('is_logged_in')) return redirect('/login');

        $total_user = DB::table('user')->count();
        $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
        $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
        $total_masjid = DB::table('masjid')->count();
        $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

        // Cek Role
        if (session('id_role') == 'R99') {
            return view('superadmin.dashboard', compact('total_user', 'total_cabang', 'total_ranting', 'total_masjid', 'masjid_terdaftar'));
        }
        // Tambahkan kondisi else if untuk role lain...
        return redirect('/login');
    }

    // Logika Persetujuan
    public function persetujuan()
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.persetujuan');
    }

    // Logika Riwayat
    public function riwayat()
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.riwayat');
    }

    // Logika Status Cabang
    public function statusCabang()
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.status_cabang');
    }
}
