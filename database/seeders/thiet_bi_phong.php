<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class thiet_bi_phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        $j = 0;
        for ($i = 1; $i <= 18; $i++) {
            DB::table('thiet_bi_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_thiet_bi' => 1, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_thiet_bi' => 3, 'so_luong' => 20, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_thiet_bi' => 4, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_thiet_bi' => 5, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_thiet_bi' => 9, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_thiet_bi' => 10, 'so_luong' => 2, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }
        $j = 6 * 18;
        for ($i = 19; $i <= 22; $i++) {
            DB::table('thiet_bi_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_thiet_bi' => 1, 'so_luong' => 60, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_thiet_bi' => 3, 'so_luong' => 30, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_thiet_bi' => 4, 'so_luong' => 60, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_thiet_bi' => 5, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_thiet_bi' => 9, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_thiet_bi' => 10, 'so_luong' => 4, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }
        $j = 6 * 18 + 6 * (22 - 19 + 1);
        $i = 23;
        DB::table('thiet_bi_phong')->insert([
            ['ma' => $j + 1, 'ma_phong' => $i, 'ma_thiet_bi' => 1, 'so_luong' => 100, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 2, 'ma_phong' => $i, 'ma_thiet_bi' => 3, 'so_luong' => 50, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 3, 'ma_phong' => $i, 'ma_thiet_bi' => 4, 'so_luong' => 100, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 4, 'ma_phong' => $i, 'ma_thiet_bi' => 5, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 5, 'ma_phong' => $i, 'ma_thiet_bi' => 6, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 6, 'ma_phong' => $i, 'ma_thiet_bi' => 7, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 7, 'ma_phong' => $i, 'ma_thiet_bi' => 8, 'so_luong' => 2, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 8, 'ma_phong' => $i, 'ma_thiet_bi' => 9, 'so_luong' => 2, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ['ma' => $j + 9, 'ma_phong' => $i, 'ma_thiet_bi' => 10, 'so_luong' => 10, 'so_luong_hu' => 0, 'ngay_tao' => $today],
        ]);

        $j = 6 * 18 + 6 * (22 - 19 + 1) + 9;
        for ($i = 24; $i <= 30; $i++) {
            DB::table('thiet_bi_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_thiet_bi' => 1, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_thiet_bi' => 3, 'so_luong' => 20, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_thiet_bi' => 4, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_thiet_bi' => 5, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_thiet_bi' => 9, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_thiet_bi' => 10, 'so_luong' => 2, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }
        $j = 6 * 18 + 6 * (22 - 19 + 1) + 9 + 6 * (30 - 24 + 1);
        for ($i = 31; $i <= 34; $i++) {
            DB::table('thiet_bi_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_thiet_bi' => 3, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_thiet_bi' => 4, 'so_luong' => 40, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_thiet_bi' => 5, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_thiet_bi' => 6, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_thiet_bi' => 8, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_thiet_bi' => 9, 'so_luong' => 1, 'so_luong_hu' => 0, 'ngay_tao' => $today],
                ['ma' => $j + 7, 'ma_phong' => $i, 'ma_thiet_bi' => 10, 'so_luong' => 2, 'so_luong_hu' => 0, 'ngay_tao' => $today],
            ]);
            $j = $j + 7;
        }
    }
}
