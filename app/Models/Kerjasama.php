<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    protected $fillable = [
        'jenis_kerja_sama', 'satker', 'mitra', 'kategori_mitra',
        'cakupan_kerja_sama', 'status', 'no_kerja_sama', 'tentang',
        'tgl_mulai', 'tgl_akhir', 'dok_scan', 'dok_fisik', 'ket',
        'implementasi_evaluasi'
    ];
}

