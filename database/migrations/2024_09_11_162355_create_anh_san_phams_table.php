<?php

use App\Models\san_pham;
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
        Schema::create('anh_san_phams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(san_pham::class)->constrained();
            $table->string('anh_san_pham')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_san_phams');
    }
};
