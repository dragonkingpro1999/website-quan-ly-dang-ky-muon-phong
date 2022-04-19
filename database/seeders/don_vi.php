<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class don_vi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('don_vi')->insert([
            ['ma' => 1, 'ten' => 'Bộ môn Công nghệ thông tin', 'mo_ta' => 'Công nghệ thông tin', 'ngay_tao' => $today],
            ['ma' => 2, 'ten' => 'Bộ môn Hệ thống thông tin', 'mo_ta' => 'Hệ thống thông tin', 'ngay_tao' => $today],
            ['ma' => 3, 'ten' => 'Bộ môn Kỹ thuật phần mềm', 'mo_ta' => 'Kỹ thuật phần mềm', 'ngay_tao' => $today],
            ['ma' => 4, 'ten' => 'Bộ môn Khoa học máy tính', 'mo_ta' => 'Khoa học máy tính', 'ngay_tao' => $today],
            ['ma' => 5, 'ten' => 'Bộ môn Mạng máy tính và truyền thông dữ liệu', 'mo_ta' => 'Mạng máy tính và truyền thông dữ liệu', 'ngay_tao' => $today],
            ['ma' => 6, 'ten' => 'Bộ môn An toàn thông tin', 'mo_ta' => 'An toàn thông tin', 'ngay_tao' => $today],
            ['ma' => 7, 'ten' => 'Bộ môn Đa phương tiện', 'mo_ta' => 'Đa phương tiện', 'ngay_tao' => $today],

            ['ma' => 8, 'ten' => 'DI17V7A1', 'mo_ta' => 'Lớp Công nghệ thông tin A1', 'ngay_tao' => $today],
            ['ma' => 9, 'ten' => 'DI17V7A2', 'mo_ta' => 'Lớp Công nghệ thông tin A2', 'ngay_tao' => $today],
            ['ma' => 10, 'ten' => 'DI17V7A3', 'mo_ta' => 'Lớp Công nghệ thông tin A3', 'ngay_tao' => $today],
            ['ma' => 11, 'ten' => 'DI17V7A4', 'mo_ta' => 'Lớp Công nghệ thông tin A4', 'ngay_tao' => $today],
            ['ma' => 12, 'ten' => 'DI17V7A5', 'mo_ta' => 'Lớp Công nghệ thông tin A5', 'ngay_tao' => $today],
        ]);
    }
}
