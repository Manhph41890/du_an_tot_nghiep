<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('huy_don_hangs', function (Blueprint $table) {
            // Cập nhật giá trị enum cho cột 'trang_thai'
            DB::statement("ALTER TABLE huy_don_hangs MODIFY COLUMN trang_thai ENUM('Xác nhận hủy', 'Từ chối hủy', 'Chờ xác nhận hủy')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('huy_don_hangs', function (Blueprint $table) {
            // Hoàn tác lại enum cũ
            DB::statement("ALTER TABLE huy_don_hangs MODIFY COLUMN trang_thai ENUM('Xác nhận hủy', 'Từ chối hủy')");
        });
    }
};
