<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Thay đổi giá trị ENUM bằng query thủ công
        DB::statement("ALTER TABLE `phuong_thuc_thanh_toans` MODIFY COLUMN `kieu_thanh_toan` ENUM(
            'Thanh toán khi nhận hàng',
            'Thanh toán bằng Vnpay',
            'Thanh toán bằng Ví' -- Giá trị mới
        ) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hoàn tác thay đổi giá trị ENUM
        DB::statement("ALTER TABLE `phuong_thuc_thanh_toans` MODIFY COLUMN `kieu_thanh_toan` ENUM(
            'Thanh toán khi nhận hàng',
            'Thanh toán online' -- Giá trị cũ
        ) NOT NULL");
    }
};
