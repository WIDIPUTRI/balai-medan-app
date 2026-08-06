<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'uraian',
        'level',
        'parent_id',
        'pagu_revisi',
        'limit_pagu',
        'realisasi_lalu',
        'realisasi_ini',
        'urutan'
    ];

    protected $casts = [
        'pagu_revisi' => 'decimal:2',
        'limit_pagu' => 'decimal:2',
        'realisasi_lalu' => 'decimal:2',
        'realisasi_ini' => 'decimal:2',
    ];

    // Parent relationship
    public function parent()
    {
        return $this->belongsTo(Anggaran::class, 'parent_id');
    }

    // Children relationship
    public function children()
    {
        return $this->hasMany(Anggaran::class, 'parent_id')->orderBy('urutan');
    }

    // Recursive children
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Total realisasi s.d. periode
    public function getRealisasiTotalAttribute()
    {
        return $this->realisasi_lalu + $this->realisasi_ini;
    }

    // Persentase realisasi
    public function getPersenRealisasiAttribute()
    {
        if ($this->pagu_revisi <= 0)
            return 0;
        return round(($this->realisasi_total / $this->pagu_revisi) * 100, 2);
    }

    // Sisa anggaran
    public function getSisaAnggaranAttribute()
    {
        return $this->pagu_revisi - $this->realisasi_total;
    }

    // Get level color class
    public function getLevelColorAttribute()
    {
        return match ($this->level) {
            'program' => 'bg-cyan-100 text-cyan-800 font-bold',
            'kegiatan' => 'bg-blue-50 text-blue-700 font-semibold',
            'sub_kegiatan' => 'bg-green-50 text-green-700',
            'akun' => 'bg-white text-gray-700',
            default => 'bg-white'
        };
    }

    // Get indent level for display
    public function getIndentLevelAttribute()
    {
        return match ($this->level) {
            'program' => 0,
            'kegiatan' => 1,
            'sub_kegiatan' => 2,
            'akun' => 3,
            default => 0
        };
    }

    // Detailed Realisasi Relationship
    public function realisasiDetails()
    {
        return $this->hasMany(RealisasiAnggaran::class)->orderBy('tanggal', 'desc');
    }

    // Recalculate hierarchy recursively (From Detail -> Akun -> Sub -> Keg -> Prog)
    public function recalculateHierarchy()
    {
        // 1. Calculate own total
        // If has details (Akun Level), use existing details
        // If no details (Upper Levels), sum from children
        $detailTotal = $this->realisasiDetails()->sum('jumlah');
        $childrenTotal = $this->children()->sum('realisasi_ini');

        $grandTotal = $detailTotal > 0 ? $detailTotal : $childrenTotal;

        // Update self
        $this->update(['realisasi_ini' => $grandTotal]);

        // 2. Bubble up to parent
        if ($this->parent) {
            $this->parent->recalculateHierarchy();
        }
    }
}