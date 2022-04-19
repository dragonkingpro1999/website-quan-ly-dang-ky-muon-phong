<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class chuc_nang_phong extends Seeder
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
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_chuc_nang' => 2, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_chuc_nang' => 3, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_chuc_nang' => 7, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_chuc_nang' => 8, 'ngay_tao' => $today],
            ]);
            $j = $j + 4;
        }
        $j = 4 * 18;
        for ($i = 19; $i <= 22; $i++) {
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_chuc_nang' => 1, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_chuc_nang' => 2, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_chuc_nang' => 3, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_chuc_nang' => 4, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_chuc_nang' => 7, 'ngay_tao' => $today],

                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_chuc_nang' => 8, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }
        $j = 4 * 18 + 6 * (22 - 19 + 1);
        $p = 23;
        for ($i = 1; $i <= 12; $i++) {
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + $i, 'ma_phong' => $p, 'ma_chuc_nang' => $i, 'ngay_tao' => $today],
            ]);
        }


        $j = 4 * 18 + 6 * (22 - 19 + 1) + 12;
        for ($i = 24; $i <= 26; $i++) {
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_chuc_nang' => 1, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_chuc_nang' => 2, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_chuc_nang' => 5, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_chuc_nang' => 9, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_chuc_nang' => 11, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_chuc_nang' => 12, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }

        $j = 4 * 18 + 6 * (22 - 19 + 1) + 12 + 6 * (26 - 24 + 1);
        for ($i = 27; $i <= 30; $i++) {
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_chuc_nang' => 5, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_chuc_nang' => 7, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_chuc_nang' => 8, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_chuc_nang' => 9, 'ngay_tao' => $today],
                ['ma' => $j + 5, 'ma_phong' => $i, 'ma_chuc_nang' => 10, 'ngay_tao' => $today],
                ['ma' => $j + 6, 'ma_phong' => $i, 'ma_chuc_nang' => 12, 'ngay_tao' => $today],
            ]);
            $j = $j + 6;
        }

        $j = 4 * 18 + 6 * (22 - 19 + 1) + 12 + 6 * (26 - 24 + 1) + 6 * (30 - 27 + 1);
        for ($i = 31; $i <= 34; $i++) {
            DB::table('chuc_nang_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_chuc_nang' => 13, 'ngay_tao' => $today],
            ]);
            $j = $j + 1;
        }
    }
}
