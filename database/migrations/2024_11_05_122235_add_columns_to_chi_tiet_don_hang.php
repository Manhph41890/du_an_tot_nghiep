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
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->foreignId('san_pham_id')->nullable()->constrained('san_phams')->after('don_hang_id');;
            $table->foreignId('color_san_pham_id')->nullable()->constrained('color_san_phams')->after('san_pham_id');
            $table->foreignId('size_san_pham_id')->nullable()->constrained('size_san_phams')->after('color_san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chi_tiet_don_hangs', function (Blueprint $table) {
            $table->dropForeign(['color_san_pham_id']);
            $table->dropColumn('color_san_pham_id');

            $table->dropForeign(['size_san_pham_id']);
            $table->dropColumn('size_san_pham_id');
        });
    }
};