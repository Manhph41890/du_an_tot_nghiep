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
        if (!Schema::hasTable('shippers')) {
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('don_hang_id');
            $table->enum('status', ['Đã lấy hàng', 'Đang vận chuyển', 'Đã giao', 'Thành công', 'Giao lại', 'Thất bại']);
            $table->timestamps();
            $table->foreign('shipper_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('don_hang_id')->references('id')->on('don_hangs')->onDelete('cascade');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippers');
    }
};
