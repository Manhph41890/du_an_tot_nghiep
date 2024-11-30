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
        Schema::table('vi_shippers', function (Blueprint $table) {
            $table->decimal('tong_tien', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vi_shippers', function (Blueprint $table) {
            $table->dropColumn('tong_tien');
        });
    }
};
