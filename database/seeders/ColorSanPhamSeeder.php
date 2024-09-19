<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('color_san_phams')->insert([
            ['ten_color' => 'Đỏ'],
            ['ten_color' => 'Xanh'],
            ['ten_color' => 'Đen']
        ]);
    }
}
