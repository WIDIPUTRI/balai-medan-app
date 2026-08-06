<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama'];

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    // Get total pagu from all akun belanjas under this program
    public function getTotalPaguAttribute()
    {
        return $this->kegiatans->sum(function ($kegiatan) {
            return $kegiatan->subKegiatans->sum(function ($subKegiatan) {
                return $subKegiatan->akunBelanjas->sum('pagu');
            });
        });
    }

    // Get total realisasi from all akun belanjas under this program
    public function getTotalRealisasiAttribute()
    {
        return $this->kegiatans->sum(function ($kegiatan) {
            return $kegiatan->subKegiatans->sum(function ($subKegiatan) {
                return $subKegiatan->akunBelanjas->sum('realisasi');
            });
        });
    }

    public function getTotalSisaAttribute()
    {
        return $this->total_pagu - $this->total_realisasi;
    }
}
