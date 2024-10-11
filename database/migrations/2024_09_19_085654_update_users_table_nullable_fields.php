<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableNullableFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('ngay_sinh')->nullable()->change();
            $table->string('dia_chi')->nullable()->change();
            $table->string('gioi_tinh')->nullable()->change();
            $table->string('anh_dai_dien')->nullable()->change();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('ngay_sinh')->nullable(false)->change();
            $table->string('dia_chi')->nullable(false)->change();
            $table->string('gioi_tinh')->nullable(false)->change();
            $table->string('anh_dai_dien')->nullable(false)->change();
           
        });
    }
}
