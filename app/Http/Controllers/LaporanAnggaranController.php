<?php

namespace App\Http\Controllers;

use App\Models\AkunBelanja;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanAnggaranExport;

class LaporanAnggaranController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        // Ambil semua akun belanja
        $akunBelanjas = AkunBelanja::with('komponen')
            ->orderBy('kode')
            ->get();

        // Hitung transaksi bulan tersebut
        $transaksiBulanan = Transaksi::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get()
            ->groupBy('akun_belanja_id');

        // Buat data agregat
        $laporan = $akunBelanjas->map(function ($akun) use ($transaksiBulanan) {
            $totalBulan = $transaksiBulanan[$akun->id]->sum('nominal') ?? 0;
            $persentase = $akun->pagu ? round(($akun->realisasi / $akun->pagu) * 100, 2) : 0;

            return [
                'kode' => $akun->kode,
                'nama' => $akun->nama,
                'pagu' => $akun->pagu,
                'realisasi' => $akun->realisasi,
                'bulan_ini' => $totalBulan,
                'sisa' => $akun->pagu - $akun->realisasi,
                'persentase' => $persentase,
            ];
        });

        return view('anggaran.laporan.index', compact('laporan', 'month', 'year'));
    }

    public function exportPdf(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $akunBelanjas = AkunBelanja::with('komponen')->orderBy('kode')->get();
        $pdf = Pdf::loadView('anggaran.laporan.pdf', compact('akunBelanjas', 'month', 'year'))
            ->setPaper('a4', 'landscape');

        return $pdf->download("laporan-anggaran-{$month}-{$year}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        return Excel::download(new LaporanAnggaranExport($month, $year), "laporan-anggaran-{$month}-{$year}.xlsx");
    }
}
