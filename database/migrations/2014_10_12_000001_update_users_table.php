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
        Schema::table('users', function (Blueprint $table) {
            // Rename 'mat_khau' to 'password'
            // $table->renameColumn('mat_khau', 'password');

            // Make 'ngay_sinh', 'dia_chi', and 'gioi_tinh' nullable
            $table->date('ngay_sinh')->nullable()->change();
            $table->string('dia_chi')->nullable()->change();
            $table->string('gioi_tinh')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the 'password' column back to 'mat_khau'
            // $table->renameColumn('password', 'mat_khau');

            // Make 'ngay_sinh', 'dia_chi', and 'gioi_tinh' not nullable again
            $table->date('ngay_sinh')->nullable(false)->change();
            $table->string('dia_chi')->nullable(false)->change();
            $table->string('gioi_tinh')->nullable(false)->change();
        });
    }
};
