<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
     * Thực hiện thay đổi trong migration.
     */
    public function up()
    {
        // Sử dụng DB::statement để sửa cột
        DB::statement("ALTER TABLE `ls_rut_vis` MODIFY COLUMN `trang_thai` ENUM('Chờ duyệt', 'Thành công', 'Thất bại')");
    }

    /**
     * Hoàn tác thay đổi nếu rollback migration.
     */
    public function down()
    {
        DB::statement("ALTER TABLE `ls_rut_vis` MODIFY COLUMN `trang_thai` ENUM('Chờ duyệt')");
    }
};
