<?php

namespace App\Http\Controllers;

use App\Models\AkunBelanja;
use App\Models\Komponen;
use Illuminate\Http\Request;

class AkunBelanjaController extends Controller
{
    public function index()
    {
        $akunBelanjas = AkunBelanja::with('komponen')->paginate(10);
        return view('anggaran.akun.index', compact('akunBelanjas'));
    }

    public function create()
    {
        $komponens = Komponen::all();
        return view('anggaran.akun.form', compact('komponens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'komponen_id' => 'required|exists:komponens,id',
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'pagu' => 'required|numeric|min:0',
            'realisasi' => 'nullable|numeric|min:0',
        ]);
        AkunBelanja::create($validated);
        return redirect()->route('akun-belanja.index')->with('success', 'Akun Belanja berhasil ditambahkan');
    }

    public function edit(AkunBelanja $akunBelanja)
    {
        $komponens = Komponen::all();
        return view('anggaran.akun.form', compact('akunBelanja', 'komponens'));
    }

    public function update(Request $request, AkunBelanja $akunBelanja)
    {
        $validated = $request->validate([
            'komponen_id' => 'required|exists:komponens,id',
            'kode' => 'required|string|max:10',
            'nama' => 'required|string|max:255',
            'pagu' => 'required|numeric|min:0',
            'realisasi' => 'nullable|numeric|min:0',
        ]);
        $akunBelanja->update($validated);
        return redirect()->route('akun-belanja.index')->with('success', 'Akun Belanja berhasil diperbarui');
    }

    public function destroy(AkunBelanja $akunBelanja)
    {
        $akunBelanja->delete();
        return redirect()->route('akun-belanja.index')->with('success', 'Akun Belanja berhasil dihapus');
    }
}
