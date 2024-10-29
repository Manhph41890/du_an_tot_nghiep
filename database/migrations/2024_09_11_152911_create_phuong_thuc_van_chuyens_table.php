<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        if (!Schema::hasTable('phuong_thuc_van_chuyens')) {
        Schema::create('phuong_thuc_van_chuyens', function (Blueprint $table) {
            $table->id();
            $table->enum('kieu_van_chuyen', ['Giao hàng hỏa tốc', 'Giao hàng thường']);
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuong_thuc_van_chuyens');
    }
};