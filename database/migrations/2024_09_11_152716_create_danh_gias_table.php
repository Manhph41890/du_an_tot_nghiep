<?php

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
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(san_pham::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->date('ngay_danh_gia');
            $table->integer('diem_so');
            $table->string('binh_luan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};