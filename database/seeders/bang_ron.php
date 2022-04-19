<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class bang_ron extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('bang_ron')->insert([
            [
                'ma' => 1,
                'hinh_anh' => 'main2.jpg',
                'tieu_de' => 'Khoa Công Nghệ Thông Tin Và Truyền Thông | Đại học Cần Thơ',
                'ngay_tao' => $today
            ],
        ]);
    }
}
