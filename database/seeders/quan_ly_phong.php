<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class quan_ly_phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        for ($i = 1; $i <= 34; $i++) {
            DB::table('quan_ly_phong')->insert([
                ['ma' => $i, 'ma_nguoi_dung' => '1', 'ma_phong' => $i, 'co_quyen' => '1', 'ngay_tao' => $today],
            ]);
        }
    }
}
