<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class KerjasamaController extends Controller
{
    public function index()
    {
        $data = Kerjasama::paginate(15);
        return view('kerjasama.index', compact('data'));
    }

    public function create()
    {
        return view('kerjasama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kerja_sama' => 'required',
            'satker' => 'nullable',
            'mitra' => 'nullable',
            'kategori_mitra' => 'nullable',
            'cakupan_kerja_sama' => 'nullable',
            'status' => 'nullable',
            'no_kerja_sama' => 'nullable',
            'tentang' => 'nullable',
            'tgl_mulai' => 'nullable|date',
            'tgl_akhir' => 'nullable|date',
            'dok_scan' => 'nullable|mimes:pdf|max:5000',
            'dok_fisik' => 'nullable|mimes:pdf|max:5000',
            'ket' => 'nullable',
            'implementasi_evaluasi' => 'nullable'
        ]);

        $data = $request->except(['dok_scan', 'dok_fisik']);

        // ✔ Upload dokumen scan
        if ($request->hasFile('dok_scan')) {
            $data['dok_scan'] = $request->file('dok_scan')
                ->store('kerjasama/dok_scan', 'public');
        }

        // ✔ Upload dokumen fisik
        if ($request->hasFile('dok_fisik')) {
            $data['dok_fisik'] = $request->file('dok_fisik')
                ->store('kerjasama/dok_fisik', 'public');
        }

        Kerjasama::create($data);

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data kerja sama berhasil ditambahkan.');
    }

    public function download($id)
    {
        $row = Kerjasama::findOrFail($id);
        if (!$row->dok_scan) {
            abort(404);
        }

        $path = storage_path('app/public/' . $row->dok_scan);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, basename($path));
    }


    public function exportPdf()
    {
        try {
            $data = Kerjasama::all();

            // Aggressively clear buffers
            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            ob_start();
            $pdf = Pdf::loadView('kerjasama.pdf', compact('data'))
                ->setPaper('a4', 'landscape');
            $content = $pdf->output();
            ob_end_clean();

            // Save to storage
            \Illuminate\Support\Facades\Storage::disk('public')->put('kerjasama/dok_scan/dokumen.pdf', $content);

            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="dokumen.pdf"');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->getPathname();
        $spreadsheet = IOFactory::load($file);
        $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($rows as $index => $row) {
            if ($index === 1)
                continue; // skip header

            Kerjasama::create([
                'jenis_kerja_sama' => $row['A'],
                'satker' => $row['B'],
                'mitra' => $row['C'],
                'kategori_mitra' => $row['D'],
                'cakupan_kerja_sama' => $row['E'],
                'status' => $row['F'],
                'no_kerja_sama' => $row['G'],
                'tentang' => $row['H'],
                'tgl_mulai' => $row['I'],
                'tgl_akhir' => $row['J'],
                'dok_scan' => null,   // tidak import file
                'dok_fisik' => null,   // tidak import file
                'ket' => $row['K'],
                'implementasi_evaluasi' => $row['L'],
            ]);
        }

        return back()->with('success', 'Import data kerja sama berhasil!');
    }

    public function edit($id)
    {
        $data = Kerjasama::findOrFail($id);
        return view('kerjasama.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Kerjasama::findOrFail($id);

        $update = $request->except(['dok_scan', 'dok_fisik']);

        // ✔ Jika upload dokumen scan baru
        if ($request->hasFile('dok_scan')) {
            $update['dok_scan'] = $request->file('dok_scan')
                ->store('kerjasama/dok_scan', 'public');
        }

        // ✔ Jika upload dokumen fisik baru
        if ($request->hasFile('dok_fisik')) {
            $update['dok_fisik'] = $request->file('dok_fisik')
                ->store('kerjasama/dok_fisik', 'public');
        }

        $data->update($update);

        return redirect()->route('kerjasama.index')
            ->with('success', 'Data kerja sama berhasil diperbarui.');
    }

    public function laporan()
    {
        // Grafik Jenis Kerja Sama
        $jenis = Kerjasama::selectRaw('jenis_kerja_sama, COUNT(*) as total')
            ->groupBy('jenis_kerja_sama')
            ->pluck('total', 'jenis_kerja_sama');

        // Grafik Status
        $status = Kerjasama::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // Grafik Kategori Mitra
        $mitra = Kerjasama::selectRaw('kategori_mitra, COUNT(*) as total')
            ->groupBy('kategori_mitra')
            ->pluck('total', 'kategori_mitra');

        // Kerjasama yang akan berakhir dalam 90 hari
        $today = now();
        $deadline = now()->addDays(90);

        $akanBerakhir = Kerjasama::whereBetween('tgl_akhir', [$today, $deadline])
            ->orderBy('tgl_akhir', 'asc')
            ->get();

        return view('kerjasama.laporan', compact(
            'jenis',
            'status',
            'mitra',
            'akanBerakhir'
        ));
    }


    public function destroy($id)
    {
        Kerjasama::destroy($id);

        return back()->with('success', 'Data berhasil dihapus.');
    }
}
