<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('size_san_phams')->insert([
            ['ten_size' => 'A1'],
            ['ten_size' => 'A2'],
            ['ten_size' => 'A3']
        ]);
    }
}
