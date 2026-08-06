<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['kegiatan_id', 'kode', 'nama'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function akunBelanjas()
    {
        return $this->hasMany(AkunBelanja::class);
    }

    public function getTotalPaguAttribute()
    {
        return $this->akunBelanjas->sum('pagu');
    }

    public function getTotalRealisasiAttribute()
    {
        return $this->akunBelanjas->sum('realisasi');
    }

    public function getTotalSisaAttribute()
    {
        return $this->total_pagu - $this->total_realisasi;
    }
}
