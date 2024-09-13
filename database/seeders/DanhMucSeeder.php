<?php

namespace Database\Seeders;

use App\Models\danh_muc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 10; $i++) {
            danh_muc::query()->create([
                'ten_danh_muc' => 'Danh muc' . $i,
                'anh_danh_muc' => '',
                'is_active' => $i,
            ]);
        }
    }
}
