<?php

namespace Database\Seeders;

use App\Models\danh_gia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        danh_gia::query()->create([
            'san_pham_id' => 5,
            'user_id' => 1,
            'ngay_danh_gia' => $faker->date('Y-m-d', 'now'), 
            'diem_so' => $faker->numberBetween(1, 5),
            'binh_luan' => $faker->sentence(),
        ]);
    }
}
