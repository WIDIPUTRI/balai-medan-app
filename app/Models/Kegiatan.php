<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['program_id', 'kode', 'nama'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function subKegiatans()
    {
        return $this->hasMany(SubKegiatan::class);
    }

    public function getTotalPaguAttribute()
    {
        return $this->subKegiatans->sum(function ($subKegiatan) {
            return $subKegiatan->akunBelanjas->sum('pagu');
        });
    }

    public function getTotalRealisasiAttribute()
    {
        return $this->subKegiatans->sum(function ($subKegiatan) {
            return $subKegiatan->akunBelanjas->sum('realisasi');
        });
    }

    public function getTotalSisaAttribute()
    {
        return $this->total_pagu - $this->total_realisasi;
    }
}
