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
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->enum('status', ['Đã lấy hàng', 'Đang giao', 'Đã thành công', 'Đã hủy', 'Giao lại'])->default('Đã lấy hàng');
            $table->foreignId('don_hang_id')->nullable()->constrained('don_hangs')->onDelete('cascade'); // Quan hệ với bảng don_hangs
            $table->foreignId('chuc_vu_id')->nullable()->constrained('chuc_vus')->onDelete('set null');  // Quan hệ với bảng chuc_vus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippers');
    }
};