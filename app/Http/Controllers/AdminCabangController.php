<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; // Tambahan wajib untuk menangkap input form

class AdminCabangController extends Controller
{
    public function dashboard()
    {
        if (!session('is_logged_in')) return redirect('/login');
        if (session('id_role') != 'R01') return redirect('/dashboard');

        return view('admin_cabang.dashboard');
    }

    public function tambahMasjid()
    {
        // Menampilkan halaman form tambah data khusus cabang
        return view('admin_cabang.tambah-masjid');
    }

    public function simpanMasjid(Request $request)
    {
        // Nanti logika untuk menyimpan ke database ditaruh di sini

        // Mengembalikan user ke dashboard cabang dengan pesan sukses
        return redirect('/admin-cabang/dashboard')->with('success', 'Data masjid berhasil ditambahkan!');
    }
}
