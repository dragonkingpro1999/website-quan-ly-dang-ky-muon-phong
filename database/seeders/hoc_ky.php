<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class hoc_ky extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('hoc_ky')->insert([
            ['ma' => 1, 'ten' => 'Học kỳ 1', 'mo_ta' => 'Học kỳ 1', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Học kỳ 2', 'mo_ta' => 'Học kỳ 2', 'ngay_tao' => $today],
            ['ma' => 3, 'ten' => 'Học kỳ hè', 'mo_ta' => 'Học kỳ hè', 'ngay_tao' => $today],
        ]);
    }
}
