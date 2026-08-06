<?php

namespace App\Exports;

use App\Models\AkunBelanja;
use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanAnggaranExport implements FromView
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        $akunBelanjas = AkunBelanja::with('komponen')->orderBy('kode')->get();
        $transaksiBulanan = Transaksi::whereYear('tanggal', $this->year)
            ->whereMonth('tanggal', $this->month)
            ->get()
            ->groupBy('akun_belanja_id');

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

        return view('anggaran.laporan.export_excel', [
            'laporan' => $laporan,
            'month' => $this->month,
            'year' => $this->year
        ]);
    }
}
