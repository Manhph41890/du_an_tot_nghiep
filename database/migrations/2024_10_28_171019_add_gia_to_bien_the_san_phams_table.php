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
        Schema::table('bien_the_san_phams', function (Blueprint $table) {
            $table->decimal('gia', 10, 2)->default(0); // Thêm trường giá

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bien_the_san_phams', function (Blueprint $table) {
            $table->dropColumn('gia'); // Xóa trường giá

        });
    }
};