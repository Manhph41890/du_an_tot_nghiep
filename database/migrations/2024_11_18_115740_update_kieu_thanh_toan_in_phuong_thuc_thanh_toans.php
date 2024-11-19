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
        Schema::table('phuong_thuc_thanh_toans', function (Blueprint $table) {
            // Sử dụng đổi cột enum sang giá trị mới
            $table->enum('kieu_thanh_toan', ['Thanh toán bằng Vnpay', 'Thanh toán bằng Ví', 'Thanh toán khi nhận hàng'])
                ->default('Thanh toán khi nhận hàng')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phuong_thuc_thanh_toans', function (Blueprint $table) {
            // // Khôi phục về giá trị ban đầu
            $table->enum('kieu_thanh_toan', ['Thanh toán online', 'Thanh toán khi nhận hàng'])
                ->default('Thanh toán khi nhận hàng')
                ->change();
        });
    }
};
