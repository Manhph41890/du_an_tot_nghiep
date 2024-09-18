<?php

use App\Models\khuyen_mai;
use App\Models\phuong_thuc_thanh_toan;
use App\Models\phuong_thuc_van_chuyen;
use App\Models\san_pham;
use App\Models\User;
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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(san_pham::class)->constrained();
            $table->foreignIdFor(khuyen_mai::class)->constrained();
            $table->foreignIdFor(phuong_thuc_thanh_toan::class)->constrained();
            $table->foreignIdFor(phuong_thuc_van_chuyen::class)->constrained();
            $table->date('ngay_tao');
            $table->decimal('tong_tien');
            $table->string('ho_ten');
            $table->string('email');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->enum('trang_thai', ['Đặt hàng thành công ', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
