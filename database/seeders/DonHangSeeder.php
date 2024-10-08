<?php

namespace Database\Seeders;

use App\Models\don_hang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('don_hangs')->insert([
            'user_id' =>  1,
            'san_pham_id' => 4,
            'khuyen_mai_id' => 1,
            'phuong_thuc_thanh_toan_id' => 1,
            'phuong_thuc_van_chuyen_id' => 1,
            'ngay_tao' => '6445-10-3',
            'tong_tien' => 100000,
            'ho_ten' => 'ho_ten   ',
            'email' => 'email   ',
            'so_dien_thoai' => '0901789',
            'dia_chi' => 'dia_chi',
            'trang_thai' => 0,
        ]);
        // }
    }
}
