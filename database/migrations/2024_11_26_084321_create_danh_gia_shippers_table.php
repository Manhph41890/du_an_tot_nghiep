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
        Schema::create('danh_gia_shippers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipper_id')->constrained()->onDelete('cascade'); // Liên kết với bảng shipper
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Liên kết với người dùng đánh giá
            $table->integer('diem_so')->default(0); // Điểm đánh giá
            $table->text('binh_luan')->nullable(); // Bình luận đánh giá
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gia_shippers');
    }
};
