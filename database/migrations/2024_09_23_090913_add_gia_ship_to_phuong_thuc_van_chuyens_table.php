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
        Schema::table('phuong_thuc_van_chuyens', function (Blueprint $table) {
            //
            $table->integer('gia_ship')->default(0); // Thêm cột giá ship
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phuong_thuc_van_chuyens', function (Blueprint $table) {
            $table->dropColumn('gia_ship'); // Xóa cột giá ship

        });
    }
};