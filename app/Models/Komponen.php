<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model {
    protected $fillable = ['sub_kegiatan_id','kode','nama'];
    public function subKegiatan() { return $this->belongsTo(SubKegiatan::class); }
    public function akunBelanjas() { return $this->hasMany(AkunBelanja::class); }
}
