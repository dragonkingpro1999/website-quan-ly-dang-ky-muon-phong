<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class nam_hoc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('nam_hoc')->insert([
            ['ma' => 1, 'nam_dau' => 2020, 'nam_sau' => 2021, 'ngay_tao' => $today],
            ['ma' => 2, 'nam_dau' => 2021, 'nam_sau' => 2022, 'ngay_tao' => $today],
            ['ma' => 3, 'nam_dau' => 2022, 'nam_sau' => 2023, 'ngay_tao' => $today],
        ]);
    }
}
