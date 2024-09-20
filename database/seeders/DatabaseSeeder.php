<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // DanhMucSeeder::class,
            ColorSanPhamSeeder::class,
            SizeSanPhamSeeder::class,
            SanPhamSeeder::class,
            BienTheSanPhamSeeder::class,
            AnhSanPhamSeeder::class,
<<<<<<< HEAD
            // ChucVuSeeder::class,
            DanhMucSeeder::class,
=======
>>>>>>> 4d54e452c940a9909296a0b48559993c10c55a10
        ]);
    }
}