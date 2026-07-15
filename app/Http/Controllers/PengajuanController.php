<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * PengajuanController — daftar pengajuan milik masjid yang sedang login (R02).
 * Pengurus masjid dapat melihat status pengajuan perubahan datanya
 * (pending / approved / rejected) yang diproses oleh admin cabang.
 */
class PengajuanController extends Controller
{
    private function guard()
    {
        return session('id_role') == 'R02' && session('id_masjid');
    }

    public function index()
    {
        if (!$this->guard()) return redirect('/dashboard');

        $items = DB::table('pengajuan')
            ->where('id_masjid', session('id_masjid'))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'deskripsi' => 'required|string|max:500',
        ]);

        $c = DB::table('pengajuan')->count() + 1;
        $id = 'PGJ' . str_pad((string) $c, 4, '0', STR_PAD_LEFT);

        DB::table('pengajuan')->insert([
            'id_pengajuan'    => $id,
            'id_masjid'       => session('id_masjid'),
            'id_user_pengaju' => session('id_user'),
            'jenis_pengajuan' => 'edit_masjid',
            'deskripsi'       => $request->deskripsi,
            'data_baru'       => json_encode([]),
            'status'          => 'pending',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return back()->with('success', 'Pengajuan dikirim ke admin cabang.');
    }
}
