<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->date('kp_tanggal_sk')->nullable();
            $table->date('kp_tmt')->nullable();
            $table->string('kp_selanjutnya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['kp_tanggal_sk', 'kp_tmt', 'kp_selanjutnya']);
        });
    }
};
