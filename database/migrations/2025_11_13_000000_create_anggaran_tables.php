<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('kategori')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->string('kode');
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('komponens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kegiatan_id')->constrained('sub_kegiatans')->onDelete('cascade');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('akun_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komponen_id')->constrained('komponens')->onDelete('cascade');
            $table->string('kode');
            $table->string('nama');
            $table->decimal('pagu', 20, 2)->default(0);
            $table->decimal('realisasi', 20, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_belanja_id')->constrained('akun_belanjas')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('uraian');
            $table->decimal('nominal', 20, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('akun_belanjas');
        Schema::dropIfExists('komponens');
        Schema::dropIfExists('sub_kegiatans');
        Schema::dropIfExists('kegiatans');
        Schema::dropIfExists('programs');
    }
};
