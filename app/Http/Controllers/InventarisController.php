<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    private function guard()
    {
        return session('id_role') == 'R02' && session('id_masjid');
    }

    private function nextId(): string
    {
        $c = DB::table('inventaris')->count() + 1;
        return 'INV' . str_pad((string) $c, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        if (!$this->guard()) return redirect('/dashboard');

        $items = DB::table('inventaris')
            ->where('id_masjid', session('id_masjid'))
            ->orderBy('nama_barang')->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'jumlah'      => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
            'tanggal_pengadaan' => 'nullable|date',
        ]);

        DB::table('inventaris')->insert([
            'id_inventaris'     => $this->nextId(),
            'id_masjid'         => session('id_masjid'),
            'nama_barang'       => $request->nama_barang,
            'jumlah'            => $request->jumlah,
            'kondisi'           => $request->kondisi,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return back()->with('success', 'Inventaris ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'jumlah'      => 'required|integer|min:0',
            'kondisi'     => 'required|in:baik,rusak ringan,rusak berat',
        ]);

        DB::table('inventaris')
            ->where('id_inventaris', $id)
            ->where('id_masjid', session('id_masjid'))
            ->update([
                'nama_barang' => $request->nama_barang,
                'jumlah'      => $request->jumlah,
                'kondisi'     => $request->kondisi,
                'updated_at'  => now(),
            ]);

        return back()->with('success', 'Inventaris diperbarui.');
    }

    public function destroy(string $id)
    {
        if (!$this->guard()) return redirect('/dashboard');

        DB::table('inventaris')
            ->where('id_inventaris', $id)
            ->where('id_masjid', session('id_masjid'))
            ->delete();

        return back()->with('success', 'Inventaris dihapus.');
    }
}
