<?php

use App\Models\bien_the_san_pham;
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
        Schema::table('don_hangs', function (Blueprint $table) {
            // $table->foreignIdFor(bien_the_san_pham::class)->constrained()->nullable()->after('san_pham_id');
            $table->foreignId('bien_the_san_pham_id')->nullable()->constrained('bien_the_san_phams')->after('san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('don_hangs', function (Blueprint $table) {
            $table->dropForeign(['bien_the_san_pham_id']); // Xóa khóa ngoại
            $table->dropColumn('bien_the_san_pham_id'); // Xóa cột
        });
    }
};