<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * DataMasjidController
 *
 * Menyediakan daftar masjid untuk masing-masing peran sesuai alur:
 *  - Admin Ranting (R03): masjid di rantingnya (semua status, agar bisa pantau pending).
 *  - Admin Cabang  (R01): masjid yang sudah APPROVED di cabangnya (data jadi).
 *  - Superadmin    (R99): seluruh masjid yang sudah APPROVED (hanya melihat).
 */
class DataMasjidController extends Controller
{
    /** Admin Ranting — daftar masjid di rantingnya sendiri. */
    public function ranting(Request $request)
    {
        if (session('id_role') != 'R03') return redirect('/dashboard');

        $masjid = DB::table('masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->where('masjid.id_ranting', session('id_ranting'))
            ->select('masjid.*', 'ranting.nama_ranting')
            ->orderBy('masjid.nama_masjid')
            ->get();

        return view('admin_ranting.data-masjid', compact('masjid'));
    }

    /** Admin Cabang — daftar masjid APPROVED di cabangnya. */
    public function cabang(Request $request)
    {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $rantingIds = DB::table('ranting')
            ->where('id_cabang', session('id_cabang'))
            ->pluck('id_ranting');

        $masjid = DB::table('masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->where('masjid.status_data', 'approved')
            ->select('masjid.*', 'ranting.nama_ranting')
            ->orderBy('masjid.nama_masjid')
            ->get();

        return view('admin_cabang.data-masjid', compact('masjid'));
    }

    /** Superadmin — seluruh masjid APPROVED (read only). */
    public function superadmin(Request $request)
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');

        $masjid = DB::table('masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('cabang', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->where('masjid.status_data', 'approved')
            ->select('masjid.*', 'ranting.nama_ranting', 'cabang.nama_cabang')
            ->orderBy('cabang.nama_cabang')
            ->orderBy('masjid.nama_masjid')
            ->get();

        return view('superadmin.status-masjid', compact('masjid'));
    }
}
