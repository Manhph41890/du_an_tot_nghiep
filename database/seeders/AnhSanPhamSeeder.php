<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnhSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anh_san_phams')->insert([
            [
                'san_pham_id' => 1,
                'anh_san_pham' => 'https://example.com/images/aothunnam1.jpg',
            ],
            [
                'san_pham_id' => 1,
                'anh_san_pham' => 'https://example.com/images/aothunnam2.jpg',
            ],
            [
                'san_pham_id' => 2,
                'anh_san_pham' => 'https://example.com/images/vaynu1.jpg',
            ]
        ]);
    }
}
