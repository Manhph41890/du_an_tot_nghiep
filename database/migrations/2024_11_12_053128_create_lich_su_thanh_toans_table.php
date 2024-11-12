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
        Schema::create('lich_su_thanh_toans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(don_hang::class)->constrained();
            $table->string('vnp_TxnRef_id');
            $table->dateTime('vnp_ngay_tao');
            $table->decimal('vnp_tong_tien', 10, 2);
            $table->enum('trang_thai', ['Thanh toán thành công', 'Thanh toán thất bại']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_thanh_toans');
    }
};
