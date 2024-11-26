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
        Schema::create('shipper_profits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipper_id'); // Liên kết đến shipper
            $table->decimal('total_profit', 15, 2)->default(0); // Tổng lợi nhuận
            $table->timestamps();

            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipper_profits');
    }
};