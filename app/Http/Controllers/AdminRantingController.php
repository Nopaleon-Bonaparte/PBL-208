<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminRantingController extends Controller
{
    public function dashboard()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R03') return redirect('/dashboard');

        return view('admin_ranting.dashboard');
    }

    // INI DIA FUNGSI YANG DICARI OLEH ERROR TADI
    public function indexMasjid()
    {
        // Menampilkan halaman tabel masjid
        return view('admin_ranting.status-masjid');
    }

    public function tambahMasjid()
    {
        // Menampilkan form tambah data
        return view('admin_ranting.tambah-masjid');
    }

    public function simpanMasjid(Request $request)
    {
        // Nanti kode untuk simpan ke database ditaruh sini

        return redirect('/admin-ranting/dashboard')->with('success', 'Data masjid berhasil ditambahkan!');
    }
}
