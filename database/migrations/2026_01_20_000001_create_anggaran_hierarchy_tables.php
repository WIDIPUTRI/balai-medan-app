<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop old tables if exist
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('akun_belanjas');
        Schema::dropIfExists('komponens');
        Schema::dropIfExists('sub_kegiatans');
        Schema::dropIfExists('kegiatans');
        Schema::dropIfExists('programs');

        // Create Programs table
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->timestamps();
        });

        // Create Kegiatans table
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();

            $table->unique(['program_id', 'kode']);
        });

        // Create Sub Kegiatans table
        Schema::create('sub_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->cascadeOnDelete();
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();

            $table->unique(['kegiatan_id', 'kode']);
        });

        // Create Akun Belanjas table
        Schema::create('akun_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kegiatan_id')->constrained('sub_kegiatans')->cascadeOnDelete();
            $table->string('kode');
            $table->string('nama');
            $table->decimal('pagu', 15, 2)->default(0);
            $table->decimal('realisasi', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['sub_kegiatan_id', 'kode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akun_belanjas');
        Schema::dropIfExists('sub_kegiatans');
        Schema::dropIfExists('kegiatans');
        Schema::dropIfExists('programs');
    }
};
