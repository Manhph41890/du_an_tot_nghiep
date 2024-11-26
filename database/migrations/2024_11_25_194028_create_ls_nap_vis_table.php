<?php

use App\Models\Bank;
use App\Models\vi_nguoi_dung;
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
        Schema::create('ls_nap_vis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(vi_nguoi_dung::class)->constrained();
            $table->foreignIdFor(Bank::class)->constrained();
            $table->dateTime('thoi_gian_nap');
            $table->decimal('tien_nap', 15, 2);
            $table->enum('trang_thai', ['Chờ xử lý', 'Thành công', 'Thất bại']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa bảng ls_nap_vis
        Schema::dropIfExists('ls_nap_vis');
    }
};
