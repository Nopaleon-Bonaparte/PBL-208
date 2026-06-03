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

        $role = session('id_role');

        if ($role == 'R99') {
            $total_user = DB::table('user')->count();
            $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
            $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
            $total_masjid = DB::table('masjid')->count();
            $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();
            return view('superadmin.dashboard', compact('total_user', 'total_cabang', 'total_ranting', 'total_masjid', 'masjid_terdaftar'));

        } elseif ($role == 'R01') {
            return redirect('/admin-cabang/dashboard');

        } elseif ($role == 'R03') {
            return redirect('/admin-ranting/dashboard');

        } elseif ($role == 'R02') {
            return redirect('/pengurus-masjid/dashboard');

        } else {
            session()->flush();
            return redirect('/login')->withErrors(['loginError' => 'Role tidak dikenali!']);
        }
    }

    // Logika Persetujuan
    public function persetujuan()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.persetujuan');
    }

    // Logika Riwayat
    public function riwayat()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.riwayat');
    }

    // Logika Status Cabang
    public function statusCabang()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R99') return redirect('/dashboard');
        return view('superadmin.status-cabang');
    }
}
