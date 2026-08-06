<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Barryvdh\DomPDF\Facade\Pdf;

class FinanceController extends Controller
{
    /**
     * Tampilkan daftar transaksi keuangan
     */
    public function index()
    {
        $finances = Finance::with('user')->latest()->paginate(10);
        return view('keuangan.index', compact('finances'));
    }

    /**
     * Form tambah transaksi baru
     */
    public function create()
    {
        return view('keuangan.create');
    }

    /**
     * Simpan transaksi ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'category' => 'nullable|string|max:100',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('finances', 'public');
        }

        Finance::create($validated);

        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Form edit transaksi
     */
    public function edit(Finance $keuangan)
    {
        return view('keuangan.edit', compact('keuangan'));
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, Finance $keuangan)
    {
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'category' => 'nullable|string|max:100',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            if ($keuangan->attachment) {
                Storage::disk('public')->delete($keuangan->attachment);
            }
            $validated['attachment'] = $request->file('attachment')->store('finances', 'public');
        }

        $keuangan->update($validated);

        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy(Finance $keuangan)
    {
        if ($keuangan->attachment) {
            Storage::disk('public')->delete($keuangan->attachment);
        }

        $keuangan->delete();

        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Laporan bulanan
     */
    public function laporan(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $finances = Finance::whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->get();

        $pemasukan = $finances->where('type', 'pemasukan')->sum('amount');
        $pengeluaran = $finances->where('type', 'pengeluaran')->sum('amount');
        $saldo = $pemasukan - $pengeluaran;

        $monthlyData = Finance::selectRaw('CAST(strftime("%m", transaction_date) AS INTEGER) as bulan, 
                SUM(CASE WHEN type = "pemasukan" THEN amount ELSE 0 END) as total_pemasukan,
                SUM(CASE WHEN type = "pengeluaran" THEN amount ELSE 0 END) as total_pengeluaran')
            ->whereYear('transaction_date', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('keuangan.laporan', compact(
            'finances',
            'pemasukan',
            'pengeluaran',
            'saldo',
            'monthlyData',
            'month',
            'year'
        ));
    }

    /**
     * Export laporan ke Excel
     */
    public function exportExcel()
    {
        $data = Finance::all(['transaction_date', 'type', 'amount', 'description', 'category']);

        $path = storage_path('app/public/laporan_keuangan.xlsx');
        $writer = SimpleExcelWriter::create($path);

        $writer->addRow(['Tanggal', 'Jenis', 'Kategori', 'Jumlah (Rp)', 'Keterangan']);

        foreach ($data as $row) {
            $writer->addRow([
                'Tanggal' => \Carbon\Carbon::parse($row->transaction_date)->format('d/m/Y'),
                'Jenis' => ucfirst($row->type),
                'Kategori' => $row->category ?? '-',
                'Jumlah (Rp)' => number_format($row->amount, 0, ',', '.'),
                'Keterangan' => $row->description,
            ]);
        }

        return response()->download($path)->deleteFileAfterSend(true);
    }

    /**
     * Export laporan ke PDF
     */
    public function exportPdf()
    {
        try {
            $data = Finance::latest()->get();

            // Aggressively clear buffers
            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            ob_start();
            $pdf = Pdf::loadView('keuangan.laporan_pdf', ['data' => $data]);
            $content = $pdf->output();
            ob_end_clean();

            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="laporan_keuangan.pdf"');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
