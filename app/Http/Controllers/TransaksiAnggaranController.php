<?php

namespace App\Http\Controllers;

use App\Models\{Transaksi, AkunBelanja};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiAnggaranController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('akunBelanja')->latest()->paginate(10);
        return view('anggaran.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $akunBelanjas = AkunBelanja::all();
        return view('anggaran.transaksi.form', compact('akunBelanjas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'akun_belanja_id' => 'required|exists:akun_belanjas,id',
            'tanggal' => 'required|date',
            'uraian' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            // Simpan transaksi baru
            $transaksi = Transaksi::create($validated);

            // Update realisasi akun
            $this->updateRealisasi($transaksi->akun_belanja_id);
        });

        return redirect()->route('transaksi-anggaran.index')->with('success', 'Transaksi berhasil ditambahkan dan realisasi diperbarui');
    }

    public function edit(Transaksi $transaksi_anggaran)
    {
        $akunBelanjas = AkunBelanja::all();
        return view('anggaran.transaksi.form', [
            'transaksi' => $transaksi_anggaran,
            'akunBelanjas' => $akunBelanjas
        ]);
    }

    public function update(Request $request, Transaksi $transaksi_anggaran)
    {
        $validated = $request->validate([
            'akun_belanja_id' => 'required|exists:akun_belanjas,id',
            'tanggal' => 'required|date',
            'uraian' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $validated, $transaksi_anggaran) {
            $oldAkunId = $transaksi_anggaran->akun_belanja_id;

            // Update transaksi
            $transaksi_anggaran->update($validated);

            // Update akun lama dan akun baru jika berbeda
            $this->updateRealisasi($oldAkunId);
            $this->updateRealisasi($validated['akun_belanja_id']);
        });

        return redirect()->route('transaksi-anggaran.index')->with('success', 'Transaksi berhasil diperbarui dan realisasi disesuaikan');
    }

    public function destroy(Transaksi $transaksi_anggaran)
    {
        DB::transaction(function () use ($transaksi_anggaran) {
            $akunId = $transaksi_anggaran->akun_belanja_id;

            // Hapus transaksi
            $transaksi_anggaran->delete();

            // Perbarui realisasi akun
            $this->updateRealisasi($akunId);
        });

        return redirect()->route('transaksi-anggaran.index')->with('success', 'Transaksi dihapus dan realisasi diperbarui');
    }

    /**
     * Hitung ulang total realisasi pada akun belanja tertentu
     */
    private function updateRealisasi($akunBelanjaId)
    {
        $totalRealisasi = Transaksi::where('akun_belanja_id', $akunBelanjaId)->sum('nominal');

        AkunBelanja::where('id', $akunBelanjaId)
            ->update(['realisasi' => $totalRealisasi]);
    }
}
