<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class phan_quyen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('phan_quyen')->insert([
            ['ma' => 1, 'ma_quyen' => 1, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 2, 'ma_quyen' => 2, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 3, 'ma_quyen' => 3, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 4, 'ma_quyen' => 4, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 5, 'ma_quyen' => 5, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 6, 'ma_quyen' => 6, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 7, 'ma_quyen' => 7, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 8, 'ma_quyen' => 8, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 9, 'ma_quyen' => 9, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 10, 'ma_quyen' => 10, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 11, 'ma_quyen' => 11, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            ['ma' => 12, 'ma_quyen' => 12, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],

            // ['ma' => 9, 'ma_quyen' => 1, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 10, 'ma_quyen' => 2, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 11, 'ma_quyen' => 3, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 12, 'ma_quyen' => 4, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 13, 'ma_quyen' => 5, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 14, 'ma_quyen' => 6, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 15, 'ma_quyen' => 7, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 16, 'ma_quyen' => 8, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],

            // ['ma' => 17, 'ma_quyen' => 1, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 18, 'ma_quyen' => 2, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 19, 'ma_quyen' => 3, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 20, 'ma_quyen' => 4, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 21, 'ma_quyen' => 5, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 22, 'ma_quyen' => 6, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 23, 'ma_quyen' => 7, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 24, 'ma_quyen' => 8, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],

            // ['ma' => 25, 'ma_quyen' => 1, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 26, 'ma_quyen' => 2, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 27, 'ma_quyen' => 3, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 28, 'ma_quyen' => 4, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 29, 'ma_quyen' => 5, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 30, 'ma_quyen' => 6, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 31, 'ma_quyen' => 7, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 32, 'ma_quyen' => 8, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],

            // ['ma' => 33, 'ma_quyen' => 1, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 34, 'ma_quyen' => 2, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 35, 'ma_quyen' => 3, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 36, 'ma_quyen' => 4, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 37, 'ma_quyen' => 5, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 38, 'ma_quyen' => 6, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 39, 'ma_quyen' => 7, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 40, 'ma_quyen' => 8, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],

            // ['ma' => 41, 'ma_quyen' => 9, 'ma_nguoi_dung' => '1', 'co_quyen' => '1', 'ngay_tao' => $today],
            // ['ma' => 42, 'ma_quyen' => 9, 'ma_nguoi_dung' => '2', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 43, 'ma_quyen' => 9, 'ma_nguoi_dung' => '3', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 44, 'ma_quyen' => 9, 'ma_nguoi_dung' => '4', 'co_quyen' => '0', 'ngay_tao' => $today],
            // ['ma' => 45, 'ma_quyen' => 9, 'ma_nguoi_dung' => '5', 'co_quyen' => '0', 'ngay_tao' => $today],

        ]);
    }
}
