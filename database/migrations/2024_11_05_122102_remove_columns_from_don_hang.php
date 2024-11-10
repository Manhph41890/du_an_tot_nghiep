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
            $table->dropForeign(['color_san_pham_id']);
            $table->dropColumn('color_san_pham_id');

            $table->dropForeign(['size_san_pham_id']);
            $table->dropColumn('size_san_pham_id');

            // 'san_pham_id',
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            // $table->unsignedBigInteger('san_pham_id')->nullable();
            $table->unsignedBigInteger('color_san_pham_id')->nullable();
            $table->unsignedBigInteger('size_san_pham_id')->nullable();
        });
    }
};