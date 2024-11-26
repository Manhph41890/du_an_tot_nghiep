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
        Schema::create('lien_hes', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->string('name'); 
            $table->string('email');
            $table->string('phone'); 
            $table->string('subject');
             // Tiêu đề liên hệ
            $table->text('contact_message')->nullable(); 
            // Nội dung tin nhắn
            $table->enum('trang_thai', ['Chưa xử lý', 'Đã xử lý'])->default('Chưa xử lý'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lien_hes');
    }
};
