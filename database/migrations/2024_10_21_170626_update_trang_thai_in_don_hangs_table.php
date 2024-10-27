<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cập nhật các giá trị không hợp lệ trước
        DB::table('don_hangs')->whereNotIn('trang_thai', [
            'Chờ xác nhận', 'Đã xác nhận', 'Đang chuẩn bị hàng', 
            'Đang vận chuyển', 'Đã giao', 'Thành công', 'Đã hủy'
        ])->update(['trang_thai' => 'Chờ xác nhận']); // Thay bằng giá trị mặc định hoặc hợp lệ

        // Thay đổi kiểu ENUM
        Schema::table('don_hangs', function (Blueprint $table) {
            DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM('Chờ xác nhận', 'Đã xác nhận', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao', 'Thành công', 'Đã hủy')");
        });
    }

    public function down(): void
    {
        // Khôi phục lại ENUM cũ nếu cần thiết
        Schema::table('don_hangs', function (Blueprint $table) {
            DB::statement("ALTER TABLE don_hangs MODIFY COLUMN trang_thai ENUM('Đặt hàng thành công', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao')");
        });
    }
};
