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
        Schema::table('bai_viets', function (Blueprint $table) {
            $table->boolean('is_active')->default(true); // Thêm cột is_active
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_viets', function (Blueprint $table) {
            $table->dropColumn('is_active'); // Xóa cột nếu rollback
        });
    }
};