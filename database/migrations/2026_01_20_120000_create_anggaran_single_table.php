<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop old tables
        Schema::dropIfExists('akun_belanjas');
        Schema::dropIfExists('sub_kegiatans');
        Schema::dropIfExists('kegiatans');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('anggarans');

        // Create single anggaran table
        Schema::create('anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('uraian');
            $table->enum('level', ['program', 'kegiatan', 'sub_kegiatan', 'akun']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->decimal('pagu_revisi', 18, 2)->default(0);
            $table->decimal('limit_pagu', 18, 2)->default(0);
            $table->decimal('realisasi_lalu', 18, 2)->default(0);
            $table->decimal('realisasi_ini', 18, 2)->default(0);
            $table->integer('urutan')->default(0);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('anggarans')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggarans');
    }
};
