<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class thanh_truot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('thanh_truot')->insert([
            [
                'ma' => 1,
                'hinh_anh' => '1.jpg',
                'tieu_de' => 'Phòng chất lượng cao',
                'ngay_tao' => $today
            ],
            [
                'ma' => 2,
                'hinh_anh' => '2.jpg',
                'tieu_de' => 'Phòng máy tính',
                'ngay_tao' => $today
            ],
            [
                'ma' => 3,
                'hinh_anh' => '3.jpg',
                'tieu_de' => 'Phòng laptop',
                'ngay_tao' => $today
            ],
            [
                'ma' => 4,
                'hinh_anh' => '4.jpg',
                'tieu_de' => 'Phòng máy',
                'ngay_tao' => $today
            ],
            [
                'ma' => 5,
                'hinh_anh' => '5.jpg',
                'tieu_de' => 'Phòng họp',
                'ngay_tao' => $today
            ],
        ]);
    }
}
