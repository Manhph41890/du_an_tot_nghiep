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
        // Update unmatched values to a valid ENUM value before altering the column
        DB::table('huy_don_hangs')
            ->whereNotIn('ly_do_huy', [
                'Tôi muốn cập nhật địa chỉ/sđt nhận hàng',
                'Tôi muốn thêm/thay đổi Mã giảm giá',
                'Tôi muốn thay đổi sản phẩm (kích thước, màu sắc, số lượng…)',
                'Thủ tục thanh toán rắc rối',
                'Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn, uy tín hơn, giao nhanh hơn…)',
                'Tôi không có nhu cầu mua nữa',
                'Tôi không tìm thấy lý do hủy phù hợp',
            ])
            ->update(['ly_do_huy' => 'Tôi không có nhu cầu mua nữa']); // Giá trị mặc định

        // Sau đó thay đổi kiểu cột sang ENUM
        Schema::table('huy_don_hangs', function (Blueprint $table) {
            DB::statement("ALTER TABLE huy_don_hangs MODIFY COLUMN ly_do_huy ENUM(
            'Tôi muốn cập nhật địa chỉ/sđt nhận hàng',
            'Tôi muốn thêm/thay đổi Mã giảm giá',
            'Tôi muốn thay đổi sản phẩm (kích thước, màu sắc, số lượng…)',
            'Thủ tục thanh toán rắc rối',
            'Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn, uy tín hơn, giao nhanh hơn…)',
            'Tôi không có nhu cầu mua nữa',
            'Tôi không tìm thấy lý do hủy phù hợp'
        ) NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('huy_don_hangs', function (Blueprint $table) {
            //
        });
    }
};