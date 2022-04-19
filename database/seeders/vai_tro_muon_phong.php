<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class vai_tro_muon_phong extends Seeder
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
        // -1 ko cho phep muon
        // 0 muon ko can duyet
        // 1 muon can duyet
        for ($i = 1; $i <= 34; $i++) {
            DB::table('vai_tro_muon_phong')->insert([
                ['ma' => $j + 1, 'ma_phong' => $i, 'ma_vai_tro' => 1, 'dang_ky_duyet' => -1, 'ngay_tao' => $today],
                ['ma' => $j + 2, 'ma_phong' => $i, 'ma_vai_tro' => 2, 'dang_ky_duyet' => 1, 'ngay_tao' => $today],
                ['ma' => $j + 3, 'ma_phong' => $i, 'ma_vai_tro' => 3, 'dang_ky_duyet' => 1, 'ngay_tao' => $today],
                ['ma' => $j + 4, 'ma_phong' => $i, 'ma_vai_tro' => 4, 'dang_ky_duyet' => 1, 'ngay_tao' => $today],
            ]);
            $j = $j + 4;
        }
    }
}
