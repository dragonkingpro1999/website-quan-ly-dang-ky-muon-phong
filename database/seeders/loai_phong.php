<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class loai_phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('loai_phong')->insert([
            ['ma' => 1, 'ten' => 'Phòng thực hành', 'mo_ta' => 'Phòng thực hành', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Phòng lý thuyết', 'mo_ta' => 'Phòng lý thuyết', 'ngay_tao' => $today],
        ]);
    }
}
