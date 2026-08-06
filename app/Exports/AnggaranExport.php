<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class AnggaranExport implements FromView
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $transaksis = Transaksi::whereYear('tanggal', $this->tahun)
            ->whereMonth('tanggal', $this->bulan)
            ->with(['akunBelanja.kegiatan.program'])
            ->orderBy('tanggal', 'asc')
            ->get();

        $total = $transaksis->sum('nominal');

        return view('anggaran.export-excel', [
            'transaksis' => $transaksis,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'total' => $total,
        ]);
    }
}
