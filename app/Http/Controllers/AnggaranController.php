<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    /**
     * Display flat table with hierarchical data
     */
    public function index()
    {
        // Get all data ordered by hierarchy
        $anggarans = $this->getFlattenedHierarchy();

        // Calculate totals
        $totals = [
            'pagu_revisi' => Anggaran::where('level', 'akun')->sum('pagu_revisi'),
            'limit_pagu' => Anggaran::where('level', 'akun')->sum('limit_pagu'),
            'realisasi_lalu' => Anggaran::where('level', 'akun')->sum('realisasi_lalu'),
            'realisasi_ini' => Anggaran::where('level', 'akun')->sum('realisasi_ini'),
        ];
        $totals['realisasi_total'] = $totals['realisasi_lalu'] + $totals['realisasi_ini'];
        $totals['persen'] = $totals['pagu_revisi'] > 0 ? round(($totals['realisasi_total'] / $totals['pagu_revisi']) * 100, 2) : 0;
        $totals['sisa'] = $totals['pagu_revisi'] - $totals['realisasi_total'];

        return view('anggaran.index', compact('anggarans', 'totals'));
    }

    /**
     * Flatten hierarchy for table display
     */
    private function getFlattenedHierarchy()
    {
        $result = collect();

        // Get root items (programs)
        $programs = Anggaran::where('level', 'program')
            ->whereNull('parent_id')
            ->orderBy('urutan')
            ->get();

        foreach ($programs as $program) {
            $result->push($program);
            $this->addChildrenRecursive($result, $program);
        }

        return $result;
    }

    private function addChildrenRecursive(&$result, $parent)
    {
        $children = Anggaran::where('parent_id', $parent->id)
            ->orderBy('urutan')
            ->get();

        foreach ($children as $child) {
            $result->push($child);
            $this->addChildrenRecursive($result, $child);
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        $parents = Anggaran::whereIn('level', ['program', 'kegiatan', 'sub_kegiatan'])
            ->orderBy('urutan')
            ->get();

        return view('anggaran.create', compact('parents'));
    }

    /**
     * Store new anggaran item
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'uraian' => 'required|string',
            'level' => 'required|in:program,kegiatan,sub_kegiatan,akun',
            'parent_id' => 'nullable|exists:anggarans,id',
            'pagu_revisi' => 'nullable|numeric|min:0',
            'limit_pagu' => 'nullable|numeric|min:0',
            'realisasi_lalu' => 'nullable|numeric|min:0',
            'realisasi_ini' => 'nullable|numeric|min:0',
        ]);

        Anggaran::create([
            'kode' => $request->kode,
            'uraian' => $request->uraian,
            'level' => $request->level,
            'parent_id' => $request->parent_id,
            'pagu_revisi' => $request->pagu_revisi ?? 0,
            'limit_pagu' => $request->limit_pagu ?? 0,
            'realisasi_lalu' => $request->realisasi_lalu ?? 0,
            'realisasi_ini' => $request->realisasi_ini ?? 0,
            'urutan' => Anggaran::max('urutan') + 1,
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Data anggaran berhasil ditambahkan.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $parents = Anggaran::whereIn('level', ['program', 'kegiatan', 'sub_kegiatan'])
            ->where('id', '!=', $id)
            ->orderBy('urutan')
            ->get();

        return view('anggaran.edit', compact('anggaran', 'parents'));
    }

    /**
     * Update anggaran item
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string',
            'uraian' => 'required|string',
            'pagu_revisi' => 'nullable|numeric|min:0',
            'limit_pagu' => 'nullable|numeric|min:0',
            'realisasi_lalu' => 'nullable|numeric|min:0',
            'realisasi_ini' => 'nullable|numeric|min:0',
        ]);

        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update([
            'kode' => $request->kode,
            'uraian' => $request->uraian,
            'pagu_revisi' => $request->pagu_revisi ?? 0,
            'limit_pagu' => $request->limit_pagu ?? 0,
            'realisasi_lalu' => $request->realisasi_lalu ?? 0,
            'realisasi_ini' => $request->realisasi_ini ?? 0,
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Data anggaran berhasil diupdate.');
    }

    /**
     * Quick update values via AJAX
     */
    public function quickUpdate(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        $field = $request->field;
        $value = $request->value;

        if (in_array($field, ['pagu_revisi', 'limit_pagu', 'realisasi_lalu', 'realisasi_ini'])) {
            $anggaran->update([$field => $value]);

            return response()->json([
                'success' => true,
                'realisasi_total' => $anggaran->realisasi_total,
                'persen' => $anggaran->persen_realisasi,
                'sisa' => $anggaran->sisa_anggaran,
            ]);
        }

        return response()->json(['success' => false], 400);
    }

    /**
     * Delete anggaran item
     */
    public function destroy($id)
    {
        Anggaran::destroy($id);
        return back()->with('success', 'Data anggaran berhasil dihapus.');
    }

    /**
     * Get children for dropdown (API)
     */
    public function getChildren($parentId)
    {
        $children = Anggaran::where('parent_id', $parentId)
            ->orderBy('urutan')
            ->get(['id', 'kode', 'uraian', 'level']);

        return response()->json($children);
    }

    /**
     * Show Realisasi Input Page
     */
    public function realisasi()
    {
        // Get only 'akun' level items
        // Eager load hierarchy
        $akuns = Anggaran::where('level', 'akun')
            ->with(['parent.parent.parent', 'realisasiDetails']) // Load up to Program (Akun -> Sub -> Keg -> Prog)
            ->orderBy('urutan')
            ->get();

        // Group by Program -> Kegiatan
        $groupedAnggaran = $akuns->groupBy(function ($item) {
            return $item->parent->parent->parent->kode . ' ' . $item->parent->parent->parent->uraian;
        });

        return view('anggaran.realisasi', compact('groupedAnggaran'));
    }

    /**
     * Store Realisasi Detail
     */
    public function storeRealisasi(Request $request)
    {
        $request->validate([
            'anggaran_id' => 'required|exists:anggarans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        // Create detail
        \App\Models\RealisasiAnggaran::create([
            'anggaran_id' => $request->anggaran_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);

        // Recalculate hierarchy totals
        $anggaran = Anggaran::find($request->anggaran_id);
        $anggaran->recalculateHierarchy();

        return back()->with('success', 'Data realisasi berhasil ditambahkan.');
    }

    /**
     * Show Transaction Report
     */
    public function laporan(Request $request)
    {
        $query = \App\Models\RealisasiAnggaran::with(['anggaran.parent.parent.parent']) // Load deep hierarchy for context
            ->orderBy('tanggal', 'desc');

        // Filter by Month/Year if provided
        if ($request->has('bulan') && $request->bulan) {
            $query->whereMonth('tanggal', date('m', strtotime($request->bulan)));
            $query->whereYear('tanggal', date('Y', strtotime($request->bulan)));
        }

        $transactions = $query->paginate(20);

        return view('anggaran.laporan', compact('transactions'));
    }

    /**
     * Update Realisasi
     */
    public function updateRealisasi(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $realisasi = \App\Models\RealisasiAnggaran::findOrFail($id);

        $realisasi->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);

        // Recalculate hierarchy totals for the related Anggaran
        $realisasi->anggaran->recalculateHierarchy();

        return back()->with('success', 'Data realisasi berhasil diperbarui.');
    }

    /**
     * Export Laporan PDF
     */
    public function exportLaporan(Request $request)
    {
        try {
            $query = \App\Models\RealisasiAnggaran::with(['anggaran.parent.parent.parent'])
                ->orderBy('tanggal', 'desc');

            if ($request->has('bulan') && $request->bulan) {
                $query->whereMonth('tanggal', date('m', strtotime($request->bulan)));
                $query->whereYear('tanggal', date('Y', strtotime($request->bulan)));
            }

            $transactions = $query->get();

            // Aggressively clear buffers
            while (ob_get_level() > 0) {
                ob_end_clean();
            }

            ob_start();
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('anggaran.laporan_pdf', compact('transactions', 'request'));
            $pdf->setPaper('a4', 'landscape');
            $content = $pdf->output();
            ob_end_clean();

            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="laporan_realisasi_' . ($request->bulan ?? 'semua') . '.pdf"');
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
