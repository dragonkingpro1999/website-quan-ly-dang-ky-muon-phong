<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class cai_dat_thoi_gian_muon_phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('cai_dat_thoi_gian_muon_phong')->insert([
            [
                'ma' => 1,
                'so_gio_cach_thoi_diem_hien_tai' => 6,
                'so_phut_muon_it_nhat' => 30,
                'ngay_tao' => $today
            ],
        ]);
    }
}
