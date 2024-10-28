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

        if (!Schema::hasTable('phuong_thuc_thanh_toans')) {
            Schema::create('phuong_thuc_thanh_toans', function (Blueprint $table) {
                $table->id();
                $table->enum('kieu_thanh_toan', ['Thanh toán online', 'Thanh toán khi nhận hàng']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phuong_thuc_thanh_toans');
    }
};
