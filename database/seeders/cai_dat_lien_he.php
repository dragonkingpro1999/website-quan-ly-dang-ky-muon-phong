<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class cai_dat_lien_he extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('cai_dat_lien_he')->insert([
            [
                'ma' => 1,
                'dia_chi' => 'Đại học Cần Thơ, Khu II, Đ. 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ',
                'email' => 'khanhb1706709@student.ctu.edu.vn',
                'so_dien_thoai' => '0939822983',
                'ngay_tao' => $today
            ],
        ]);
    }
}
