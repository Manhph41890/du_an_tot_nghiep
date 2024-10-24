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
        Schema::table('color_san_phams', function (Blueprint $table) {
            $table->dropUnique('color_san_phams_ten_color_unique'); // Tên của ràng buộc unique

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('color_san_phams', function (Blueprint $table) {
            $table->unique('ten_color');
        });
    }
};