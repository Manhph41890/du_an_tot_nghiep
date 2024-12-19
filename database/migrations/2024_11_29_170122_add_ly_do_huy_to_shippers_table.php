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
        Schema::table('shippers', function (Blueprint $table) {
            // Only add the column if it doesn't already exist
            if (!Schema::hasColumn('shippers', 'ly_do_huy')) {
                $table->string('ly_do_huy')->after('status')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shippers', function (Blueprint $table) {
            // Only drop the column if it exists
            if (Schema::hasColumn('shippers', 'ly_do_huy')) {
                $table->dropColumn('ly_do_huy');
            }
        });
    }
};
