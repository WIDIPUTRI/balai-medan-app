<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Staff::paginate(10);
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'education' => 'required',
            'rank' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kp_tanggal_sk' => 'nullable|date',
            'kp_tmt' => 'nullable|date',
            'kp_selanjutnya' => 'nullable|string'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageData = file_get_contents($image->getPathname());
            $base64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode($imageData);
            $validated['photo'] = $base64;
        }

        Staff::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file')->getPathname();

        // Load Excel file
        $spreadsheet = IOFactory::load($file);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        // Skip header
        foreach ($rows as $index => $row) {
            if ($index === 0)
                continue;

            Staff::create([
                'name' => $row[0],
                'gender' => $row[1],
                'birth_place' => $row[2],
                'birth_date' => $row[3],
                'education' => $row[4],
                'rank' => $row[5],
                'position' => $row[6],
            ]);
        }

        return back()->with('success', 'Import pegawai berhasil!');
    }


    public function exportPdf()
    {
        try {
            $pegawai = Staff::all();

            // Clear any previous output (aggressively)
            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            // Start capturing output for the PDF only
            ob_start();
            $pdf = Pdf::loadView('pegawai.pdf', compact('pegawai'))->setPaper('a4', 'portrait');
            $content = $pdf->output();
            ob_end_clean();

            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="data-pegawai.pdf"');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function chart()
    {
        // =========================
        // 1. Grafik Gender
        // =========================
        $gender = Staff::selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->pluck('total', 'gender');

        // =========================
        // 2. Grafik Pendidikan (Normalisasi)
        // =========================
        $education = Staff::all()
            ->groupBy(function ($item) {
                $edu = strtoupper($item->education);

                return match (true) {
                    str_contains($edu, 'S-1') || str_contains($edu, 'S1') => 'S1',
                    str_contains($edu, 'S-2') || str_contains($edu, 'S2') => 'S2',
                    str_contains($edu, 'S-3') || str_contains($edu, 'S3') => 'S3',
                    str_contains($edu, 'D-3') || str_contains($edu, 'D3') => 'D3',
                    str_contains($edu, 'D-IV') || str_contains($edu, 'D4') => 'D4',
                    str_contains($edu, 'SMA') || str_contains($edu, 'SMK') => 'SMA/SMK',
                    default => 'Lainnya',
                };
            })
            ->map(fn($g) => $g->count());

        // =========================
        // 3. Grafik Umur
        // =========================
        $ageGroups = [
            '18-25' => Staff::whereBetween('birth_date', [now()->subYears(25), now()->subYears(18)])->count(),
            '26-35' => Staff::whereBetween('birth_date', [now()->subYears(35), now()->subYears(26)])->count(),
            '36-45' => Staff::whereBetween('birth_date', [now()->subYears(45), now()->subYears(36)])->count(),
            '46-55' => Staff::whereBetween('birth_date', [now()->subYears(55), now()->subYears(46)])->count(),
            '56+' => Staff::where('birth_date', '<=', now()->subYears(56))->count(),
        ];

        // =========================
        // 4. Grafik Pangkat
        // =========================
        $rank = Staff::selectRaw('`rank`, COUNT(*) as total')
            ->groupBy('rank')
            ->pluck('total', 'rank');

        // =========================
        // 5. Grafik Jabatan
        // =========================
        $jabatan = Staff::selectRaw('position, COUNT(*) as total')
            ->groupBy('position')
            ->pluck('total', 'position');

        // =========================
        // RETURN VIEW
        // =========================
        return view('pegawai.chart', compact(
            'gender',
            'education',
            'ageGroups',
            'rank',
            'jabatan'
        ));
    }


    public function edit($id)
    {
        $data = Staff::findOrFail($id);
        return view('pegawai.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Staff::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required|date',
            'education' => 'required',
            'rank' => 'required',
            'position' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kp_tanggal_sk' => 'nullable|date',
            'kp_tmt' => 'nullable|date',
            'kp_selanjutnya' => 'nullable|string'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageData = file_get_contents($image->getPathname());
            $base64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode($imageData);
            $validated['photo'] = $base64;
        }

        $data->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        Staff::destroy($id);
        return back()->with('success', 'Data berhasil dihapus.');
    }

    public function kpDashboard()
    {
        $pegawai = Staff::whereNotNull('kp_tanggal_sk')
            ->orWhereNotNull('kp_tmt')
            ->orWhereNotNull('kp_selanjutnya')
            ->paginate(20);
        return view('pegawai.kp', compact('pegawai'));
    }
}
