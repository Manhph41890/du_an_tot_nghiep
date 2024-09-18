<?php

use App\Models\color_san_pham;
use App\Models\san_pham;
use App\Models\size_san_pham;
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
        Schema::create('bien_the_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(san_pham::class)->constrained();
            $table->foreignIdFor(size_san_pham::class)->constrained();
            $table->foreignIdFor(color_san_pham::class)->constrained();
            $table->string('anh_bien_the')->nullable();
            $table->unique(['san_pham_id', 'size_san_pham_id', 'color_san_pham_id'], 'bien_the_san_pham_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bien_the_san_phams');
    }
};