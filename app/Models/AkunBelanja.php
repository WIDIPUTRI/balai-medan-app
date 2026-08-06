<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunBelanja extends Model
{
    use HasFactory;

    protected $fillable = ['sub_kegiatan_id', 'kode', 'nama', 'pagu', 'realisasi'];

    protected $casts = [
        'pagu' => 'decimal:2',
        'realisasi' => 'decimal:2',
    ];

    public function subKegiatan()
    {
        return $this->belongsTo(SubKegiatan::class);
    }

    // Calculated sisa attribute
    public function getSisaAttribute()
    {
        return $this->pagu - $this->realisasi;
    }

    // Helper to get full hierarchy path
    public function getFullPathAttribute()
    {
        $subKegiatan = $this->subKegiatan;
        $kegiatan = $subKegiatan->kegiatan;
        $program = $kegiatan->program;

        return "{$program->kode} > {$kegiatan->kode} > {$subKegiatan->kode} > {$this->kode}";
    }
}
