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
        Schema::create('chi_tiet_vis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(don_hang::class)->constrained();
            $table->foreignIdFor(vi_nguoi_dung::class)->constrained();
            $table->dateTime('thoi_gian_hoan');
            $table->decimal('tien_hoan', 10, 2);
            $table->enum('trang_thai', ['Thành công', 'Thất bại'])->default('Thành công');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_vis');
    }
};
