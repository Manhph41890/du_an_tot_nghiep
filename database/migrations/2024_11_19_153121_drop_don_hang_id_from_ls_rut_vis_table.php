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
        Schema::table('ls_rut_vis', function (Blueprint $table) {
            // Xóa ràng buộc khóa ngoại nếu tồn tại
            $table->dropForeign(['don_hang_id']); // Nếu có tên khóa ngoại cụ thể, sử dụng tên đó
            $table->dropColumn('don_hang_id'); // Xóa cột sau khi xóa ràng buộc
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ls_rut_vis', function (Blueprint $table) {
            //
        });
    }
};