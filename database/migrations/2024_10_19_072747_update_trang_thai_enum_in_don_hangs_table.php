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
        Schema::table('don_hangs', function (Blueprint $table) {
            DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM('Đặt hàng thành công', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao', 'Thành công', 'Đã hủy')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM('Đặt hàng thành công', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao')");
        });
    }
};