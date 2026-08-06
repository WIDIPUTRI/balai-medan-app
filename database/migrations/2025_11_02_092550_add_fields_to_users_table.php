<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        /*
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('store_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('role', ['super_admin', 'admin', 'cashier'])->default('cashier');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('education')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
        });
        */
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'gender',
                'birth_place',
                'birth_date',
                'education',
                'address',
                'phone',
                'photo',
                'notes',
                'is_active'
            ]);
        });
    }
};