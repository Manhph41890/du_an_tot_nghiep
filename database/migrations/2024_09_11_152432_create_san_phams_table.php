<?php

use App\Models\danh_muc;
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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(danh_muc::class)->constrained();
            $table->string('ten_san_pham');
            $table->decimal('gia_goc');
            $table->decimal('gia_km');
            $table->string('anh_san_pham');
            $table->integer('so_luong');
            $table->string('ma_ta_san_pham');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};