<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class thiet_bi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('thiet_bi')->insert([
            ['ma' => 1, 'ten' => 'PC', 'mo_ta' => 'Máy tính để bàn', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Laptop', 'mo_ta' => 'Máy tính xách tay', 'ngay_tao' => $today],
            ['ma' => 3, 'ten' => 'Bàn', 'mo_ta' => 'Bàn', 'ngay_tao' => $today],
            ['ma' => 4, 'ten' => 'Ghế', 'mo_ta' => 'Ghế', 'ngay_tao' => $today],
            ['ma' => 5, 'ten' => 'TV', 'mo_ta' => 'Truyền hình', 'ngay_tao' => $today],

            ['ma' => 6, 'ten' => 'Máy chiếu', 'mo_ta' => 'Máy chiếu', 'ngay_tao' => $today],
            ['ma' => 7, 'ten' => 'Máy in', 'mo_ta' => 'Máy in', 'ngay_tao' => $today],
            ['ma' => 8, 'ten' => 'Bảng phấn', 'mo_ta' => 'Bảng phấn', 'ngay_tao' => $today],
            ['ma' => 9, 'ten' => 'Bảng bút lông', 'mo_ta' => 'Bảng bút lông', 'ngay_tao' => $today],
            ['ma' => 10, 'ten' => 'Loa', 'mo_ta' => 'Loa giảng dạy', 'ngay_tao' => $today],
        ]);
    }
}
