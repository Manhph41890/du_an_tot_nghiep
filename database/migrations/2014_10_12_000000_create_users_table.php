<?php

use App\Models\chuc_vu;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(chuc_vu::class)->constrained();
            $table->string('ho_ten');
            $table->string('anh_dai_dien')->nullable();
            $table->string('email')->unique();
            $table->string('so_dien_thoai');
            $table->date('ngay_sinh');
            $table->string('dia_chi');
            $table->string('gioi_tinh');
            $table->string('mat_khau');
            $table->string('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};