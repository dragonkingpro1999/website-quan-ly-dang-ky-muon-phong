<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class vai_tro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('vai_tro')->insert([
            ['ma' => 1, 'ten' => 'Admin', 'mo_ta' => 'Người dùng admin', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Thầy/cô', 'mo_ta' => 'Người dùng giáo viên', 'ngay_tao' => $today],
            ['ma' => 3, 'ten' => 'Sinh viên', 'mo_ta' => 'Người dùng sinh viên', 'ngay_tao' => $today],
            ['ma' => 4, 'ten' => 'Khác', 'mo_ta' => 'Người dùng ngoài trường', 'ngay_tao' => $today],
        ]);
    }
}
