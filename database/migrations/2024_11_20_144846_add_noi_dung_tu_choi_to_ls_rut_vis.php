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
            //
            $table->string('noi_dung_tu_choi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ls_rut_vis', function (Blueprint $table) {
            //
            $table->dropColumn('noi_dung_tu_choi');
        });
    }
};
