<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kerjasamas', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_kerja_sama')->nullable();
        $table->string('satker')->nullable();
        $table->string('mitra')->nullable();
        $table->string('kategori_mitra')->nullable();
        $table->string('cakupan_kerja_sama')->nullable();
        $table->string('status')->nullable();
        $table->string('no_kerja_sama')->nullable();
        $table->text('tentang')->nullable();
        $table->date('tgl_mulai')->nullable();
        $table->date('tgl_akhir')->nullable();
        $table->string('dok_scan')->nullable();
        $table->string('dok_fisik')->nullable();
        $table->string('ket')->nullable();
        $table->text('implementasi_evaluasi')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerjasamas');
    }
};
