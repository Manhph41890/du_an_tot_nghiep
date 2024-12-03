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
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->enum('trang_thai_don_hang', [
                'Chờ xác nhận',
                'Đã xác nhận',
                'Đang chuẩn bị hàng',
                'Đang vận chuyển',
                'Đã giao',
                'Thành công',
                'Đã hủy',
                'Thất bại' // Thêm trạng thái mới
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            //
        });
    }
};
