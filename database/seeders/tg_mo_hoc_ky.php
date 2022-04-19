<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class tg_mo_hoc_ky extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('tg_mo_hoc_ky')->insert([
            [
                'ma' => 1,
                'ma_nam_hoc' => '1',
                'ma_hoc_ky' => '3',
                'thoi_gian_bat_dau' => '2021-05-31',
                'thoi_gian_ket_thuc' => '2021-07-25',
                'trang_thai' => false,
                'mac_dinh' => false,
                'ngay_tao' => $today
            ],
            [
                'ma' => 2,
                'ma_nam_hoc' => '2',
                'ma_hoc_ky' => '1',
                'thoi_gian_bat_dau' => '2021-08-02',
                'thoi_gian_ket_thuc' => '2021-12-26',
                'trang_thai' => true,
                'mac_dinh' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 3,
                'ma_nam_hoc' => '2',
                'ma_hoc_ky' => '2',
                'thoi_gian_bat_dau' => '2022-01-02',
                'thoi_gian_ket_thuc' => '2022-05-22',
                'trang_thai' => true,
                'mac_dinh' => false,
                'ngay_tao' => $today
            ],
            [
                'ma' => 4,
                'ma_nam_hoc' => '2',
                'ma_hoc_ky' => '3',
                'thoi_gian_bat_dau' => '2022-06-06',
                'thoi_gian_ket_thuc' => '2022-07-31',
                'trang_thai' => false,
                'mac_dinh' => false,
                'ngay_tao' => $today
            ],
        ]);
    }
}
