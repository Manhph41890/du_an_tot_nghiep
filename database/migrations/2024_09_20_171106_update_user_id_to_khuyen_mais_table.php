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
            // Thêm cột user_id với nullable trước
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Thêm khóa ngoại cho cột user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('khuyen_mais', function (Blueprint $table) {
            // Xóa khóa ngoại trước
            $table->dropForeign(['user_id']);
            
            // Sau đó xóa cột user_id
            $table->dropColumn('user_id');
        });
    }
};
