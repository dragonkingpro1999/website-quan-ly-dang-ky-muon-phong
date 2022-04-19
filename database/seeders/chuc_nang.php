<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class chuc_nang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('chuc_nang')->insert([
            ['ma' => 1, 'ten' => 'Python', 'mo_ta' => 'Phần mềm liên quan Python', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Java', 'mo_ta' => 'Phần mềm liên quan Java', 'ngay_tao' => $today],
            ['ma' => 3, 'ten' => 'JavaScript', 'mo_ta' => 'Phần mềm liên quan JavaScript', 'ngay_tao' => $today],
            ['ma' => 4, 'ten' => 'PHP', 'mo_ta' => 'Phần mềm liên quan PHP', 'ngay_tao' => $today],
            ['ma' => 5, 'ten' => 'Kotlin', 'mo_ta' => 'Phần mềm liên quan Kotlin', 'ngay_tao' => $today],

            ['ma' => 6, 'ten' => 'Swift', 'mo_ta' => 'Phần mềm liên quan Swift', 'ngay_tao' => $today],
            ['ma' => 7, 'ten' => 'C#', 'mo_ta' => 'Phần mềm liên quan C#', 'ngay_tao' => $today],
            ['ma' => 8, 'ten' => 'C và C ++', 'mo_ta' => 'Phần mềm liên quan C và C ++', 'ngay_tao' => $today],
            ['ma' => 9, 'ten' => 'Go', 'mo_ta' => 'Phần mềm liên quan Go', 'ngay_tao' => $today],
            ['ma' => 10, 'ten' => 'Matlab', 'mo_ta' => 'Phần mềm liên quan Matlab', 'ngay_tao' => $today],

            ['ma' => 11, 'ten' => 'R', 'mo_ta' => 'Phần mềm liên quan R', 'ngay_tao' => $today],
            ['ma' => 12, 'ten' => 'Ruby', 'mo_ta' => 'Phần mềm liên quan Ruby', 'ngay_tao' => $today],

            ['ma' => 13, 'ten' => 'Dạy LT', 'mo_ta' => 'Giảng dạy lý thuyết', 'ngay_tao' => $today],
        ]);
    }
}
