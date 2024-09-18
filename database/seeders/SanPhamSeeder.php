<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('san_phams')->insert([
            [
                'danh_muc_id' => 1, // 
                'ten_san_pham' => 'Cọ màu',
                'gia_goc' => 200000,
                'gia_km' => 150000,
                'anh_san_pham' => 'https://example.com/images/aothunnam.jpg',
                'so_luong' => 50,
                'ma_ta_san_pham' => 'Cọ màu đẹp',
                'is_active' => true,
            ],
            [
                'danh_muc_id' => 2, // 
                'ten_san_pham' => 'Giấy Vẽ',
                'gia_goc' => 300000,
                'gia_km' => 250000,
                'anh_san_pham' => 'https://example.com/images/vaynu.jpg',
                'so_luong' => 30,
                'ma_ta_san_pham' => 'Giấy vẽ chất lượng cao',
                'is_active' => true,
            ]
        ]);
    }
}
