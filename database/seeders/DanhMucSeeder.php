<?php

namespace Database\Seeders;

use App\Models\danh_muc;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            danh_muc::query()->create([
                'ten_danh_muc' => $faker->name,
                'anh_danh_muc' => '',
                'is_active' => rand(0, 1),
            ]);
        }
    }
}
