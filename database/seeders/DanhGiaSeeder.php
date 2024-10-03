<?php

namespace Database\Seeders;

use App\Models\danh_gia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 5; $i++){
            danh_gia::create(
                [
                    'id_bai_viet' => $i,
                    'id_khach_hang' => $i,
                    'noi_dung' => 'Noi dung danh gia thu '. $i,
                    'diem_danh_gia' => rand(1, 5),
                ]
            );

        }
    }
}
