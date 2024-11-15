<?php

use App\Models\don_hang;
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
        Schema::create('huy_don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(don_hang::class)->constrained();
            $table->text('ly_do_huy'); // Lý do hủy
            $table->dateTime('thoi_gian_huy');
            $table->enum('trang_thai', ['Xác nhận hủy', 'Từ chối hủy']); // Trạng thái hủy
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('huy_don_hangs');
    }
};
