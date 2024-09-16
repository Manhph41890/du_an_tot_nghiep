<?php

namespace Database\Seeders;

use App\Models\chuc_vu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChucVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            chuc_vu::query()->create([
                'ten_chuc_vu' => $faker->name,
                'mo_ta_chuc_vu' => $faker->randomElement(['quản trị', 'nhân viên']),
            ]);
        }
    }
}
