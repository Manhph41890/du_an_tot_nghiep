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
        Schema::table('size_san_phams', function (Blueprint $table) {
            $table->dropUnique('size_san_phams_ten_size_unique'); // Tên của ràng buộc unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('size_san_phams', function (Blueprint $table) {
            $table->unique('ten_size');
        });
    }
};