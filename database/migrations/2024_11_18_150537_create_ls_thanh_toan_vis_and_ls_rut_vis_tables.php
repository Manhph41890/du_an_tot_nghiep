<?php

use App\Models\don_hang;
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
        // Tạo bảng ls_thanh_toan_vis
        Schema::create('ls_thanh_toan_vis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(don_hang::class)->constrained();
            $table->foreignIdFor(vi_nguoi_dung::class)->constrained();
            $table->dateTime('thoi_gian_thanh_toan');
            $table->decimal('tien_thanh_toan', 15, 2);
            $table->enum('trang_thai', ['Chờ xử lý', 'Thành công', 'Thất bại']);
            $table->timestamps();
        });

        // Tạo bảng ls_rut_vis
        Schema::create('ls_rut_vis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(don_hang::class)->constrained();
            $table->foreignIdFor(vi_nguoi_dung::class)->constrained();
            $table->dateTime('thoi_gian_rut');
            $table->decimal('tien_rut', 15, 2);
            $table->enum('trang_thai', ['Thành công', 'Thất bại']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa bảng ls_thanh_toan_vis
        Schema::dropIfExists('ls_thanh_toan_vis');

        // Xóa bảng ls_rut_vis
        Schema::dropIfExists('ls_rut_vis');
    }
};
