<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('khuyen_mais', function (Blueprint $table) {
            $table->foreignId('danh_muc_id')->nullable()->constrained('danh_mucs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('khuyen_mais', function (Blueprint $table) {
            $table->dropForeign(['danh_muc_id']);
            $table->dropColumn('danh_muc_id');
        });
    }
};
