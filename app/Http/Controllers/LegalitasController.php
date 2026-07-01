<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LegalitasController extends Controller
{
    private function guard()
    {
        return session('id_role') == 'R02' && session('id_masjid');
    }

    private function nextId(): string
    {
        $c = DB::table('legalitas')->count() + 1;
        return 'LGL' . str_pad((string) $c, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        if (!$this->guard()) return redirect('/dashboard');

        $items = DB::table('legalitas')
            ->where('id_masjid', session('id_masjid'))
            ->orderBy('jenis_sertifikat')->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'jenis_sertifikat' => 'required|string|max:50',
            'nomor_sertifikat' => 'nullable|string|max:50',
            'tanggal_terbit'   => 'nullable|date',
            'status'           => 'nullable|in:aktif,tidak aktif',
        ]);

        DB::table('legalitas')->insert([
            'id_legalitas'     => $this->nextId(),
            'id_masjid'        => session('id_masjid'),
            'jenis_sertifikat' => $request->jenis_sertifikat,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'tanggal_terbit'   => $request->tanggal_terbit,
            'status'           => $request->status ?: 'aktif',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return back()->with('success', 'Legalitas ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'jenis_sertifikat' => 'required|string|max:50',
            'nomor_sertifikat' => 'nullable|string|max:50',
            'status'           => 'nullable|in:aktif,tidak aktif',
        ]);

        DB::table('legalitas')
            ->where('id_legalitas', $id)
            ->where('id_masjid', session('id_masjid'))
            ->update([
                'jenis_sertifikat' => $request->jenis_sertifikat,
                'nomor_sertifikat' => $request->nomor_sertifikat,
                'status'           => $request->status ?: 'aktif',
                'updated_at'       => now(),
            ]);

        return back()->with('success', 'Legalitas diperbarui.');
    }
}
