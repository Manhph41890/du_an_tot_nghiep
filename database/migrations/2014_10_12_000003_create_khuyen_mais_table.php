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
        Schema::create('khuyen_mais', function (Blueprint $table) {
            $table->id();
            $table->string('ten_khuyen_mai');
            $table->string('ma_khuyen_mai')->unique();
            $table->decimal('gia_tri_khuyen_mai');
            $table->integer('so_luong_ma');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khuyen_mais');
    }
};