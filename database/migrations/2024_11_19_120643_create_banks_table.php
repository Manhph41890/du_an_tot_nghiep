<?php

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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('name'); // Tên ngân hàng
            $table->string('account_number'); // Số tài khoản
            $table->string('account_holder'); // Tên chủ tài khoản
            $table->string('pin'); // Mã PIN
            $table->decimal('balance', 15, 2)->default(0); // Số tiền
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};