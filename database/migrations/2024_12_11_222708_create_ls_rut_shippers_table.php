<?php

use App\Models\Bank;
use App\Models\Vishipper;
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
        Schema::create('ls_rut_shippers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vi_shipper_id');
            $table->unsignedBigInteger('bank_id');
            $table->dateTime('thoi_gian_rut');
            $table->decimal('tien_rut', 15, 2);
            $table->string('noi_dung_tu_choi')->default(null);
            $table->enum('trang_thai', ['Chờ xử lý', 'Thành công', 'Thất bại']);
            $table->timestamps();
            $table->foreign('vi_shipper_id')->references('id')->on('vi_shippers')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ls_rut_shippers');
    }
};
