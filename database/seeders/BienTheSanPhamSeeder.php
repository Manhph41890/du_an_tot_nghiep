<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BienTheSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bien_the_san_phams')->insert([
            [
                'san_pham_id' => 1, // 
                'size_san_pham_id' => 1, // 
                'color_san_pham_id' => 1, // 
                'so_luong' => 20,
                'anh_bien_the' => 'https://example.com/images/aothunnamdo.jpg',
            ],
            [
                'san_pham_id' => 1, // 
                'size_san_pham_id' => 2, // 
                'color_san_pham_id' => 2, // 
                'so_luong' => 15,
                'anh_bien_the' => 'https://example.com/images/aothunnamxanh.jpg',
            ]
        ]);
    }
}
