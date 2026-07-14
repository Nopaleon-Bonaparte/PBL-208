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
            ->where('masjid.status_data', '!=', 'approved')
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

    /** Admin Ranting — manajemen masjid (yang sudah APPROVED) beserta detail legalitas/wakafnya. */
    public function legalitas(Request $request)
    {
        if (session('id_role') != 'R03') return redirect('/dashboard');
        
        $idRanting = session('id_ranting');

        $daftarMasjid = DB::table('masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->where('masjid.id_ranting', $idRanting)
            ->where('masjid.status_data', 'approved')
            ->select('masjid.*', 'ranting.nama_ranting')
            ->orderBy('masjid.nama_masjid')
            ->get();

        $totalMasjid = $daftarMasjid->count();
        $totalJenisM = $daftarMasjid->where('tipe', 'Masjid')->count();
        $totalJenisMu = $daftarMasjid->where('tipe', 'Musholla')->count();

        // Cari kelengkapan masing-masing masjid
        $totalBelumLengkap = 0;
        foreach ($daftarMasjid as $m) {
            $required = [
                $m->alamat, $m->kapasitas, $m->no_sk, $m->status_tanah,
                $m->jenis_sertifikat, $m->no_sertifikat, $m->nama_nazir,
                $m->sound_system, $m->jumlah_ac, $m->alat_kebersihan,
                $m->sarana_lainnya, $m->takmir_nama, $m->takmir_nik,
                $m->takmir_wa, $m->foto_bangunan, $m->file_sk,
                $m->file_sertifikat, $m->file_ktp, $m->email
            ];
            
            $filled = 0;
            foreach ($required as $field) {
                if ($field !== null && $field !== '') {
                    $filled++;
                }
            }
            
            $pct = round(($filled / count($required)) * 100);
            $m->kelengkapan_data = $pct;
            if ($pct < 100) {
                $totalBelumLengkap++;
            }
        }

        return view('admin_ranting.legalitas-masjid', compact(
            'daftarMasjid', 'totalMasjid', 'totalJenisM', 'totalJenisMu', 'totalBelumLengkap'
        ));
    }
}
