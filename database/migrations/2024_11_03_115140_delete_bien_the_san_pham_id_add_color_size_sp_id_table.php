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
            // Xóa cột bien_the_san_pham_id nếu nó đã tồn tại
            $table->dropForeign(['bien_the_san_pham_id']);
            $table->dropColumn('bien_the_san_pham_id');

            // Thêm cột color_san_pham_id và size_san_pham_id với khóa ngoại
            $table->foreignId('color_san_pham_id')->nullable()->constrained('color_san_phams')->after('san_pham_id');
            $table->foreignId('size_san_pham_id')->nullable()->constrained('size_san_phams')->after('color_san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            // Xóa các khóa ngoại và cột vừa thêm
            $table->dropForeign(['color_san_pham_id']);
            $table->dropColumn('color_san_pham_id');

            $table->dropForeign(['size_san_pham_id']);
            $table->dropColumn('size_san_pham_id');

            // Thêm lại cột bien_the_san_pham_id nếu cần khôi phục
            $table->foreignId('bien_the_san_pham_id')->nullable()->constrained('bien_the_san_phams')->after('san_pham_id');
        });
    }
};
