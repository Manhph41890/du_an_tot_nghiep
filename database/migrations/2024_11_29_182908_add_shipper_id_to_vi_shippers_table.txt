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
            $table->unsignedBigInteger('shipper_id')->after('id');
            // Tạo khóa ngoại liên kết với bảng users
            $table->foreign('shipper_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vi_shippers', function (Blueprint $table) {
            //
        });
    }
};
