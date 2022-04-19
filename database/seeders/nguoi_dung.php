<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class nguoi_dung extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('nguoi_dung')->insert([
            ['ma' => 1, 'ma_vai_tro' => 1, 'tai_khoan' => 'admin', 'password' => bcrypt('123456'), 'ten' => 'Admin', 'email' => 'khanhtran.glinking@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822980', 'ma_don_vi' => 1, 'ngay_tao' => $today],

            ['ma' => 2, 'ma_vai_tro' => 2, 'tai_khoan' => 'tmtan', 'password' => bcrypt('123456'), 'ten' => 'Trần Minh Tân', 'email' => 'khanh2020nlcs@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822981', 'ma_don_vi' => 2, 'ngay_tao' => $today],
            ['ma' => 3, 'ma_vai_tro' => 2, 'tai_khoan' => 'ptphi', 'password' => bcrypt('123456'), 'ten' => 'Phạm Thế Phi', 'email' => 'knighttgk@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822982', 'ma_don_vi' => 3, 'ngay_tao' => $today],

            ['ma' => 4, 'ma_vai_tro' => 3, 'tai_khoan' => 'b1706709', 'password' => bcrypt('123456'), 'ten' => 'Trần Gia Khánh', 'email' => 'khanhb1706709@student.ctu.edu.vn', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822983', 'ma_don_vi' => 8, 'ngay_tao' => $today],
            ['ma' => 5, 'ma_vai_tro' => 3, 'tai_khoan' => 'b1706707', 'password' => bcrypt('123456'), 'ten' => 'Nguyễn An Khang', 'email' => 'oumashupro1999@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822984', 'ma_don_vi' => 9, 'ngay_tao' => $today],
            ['ma' => 6, 'ma_vai_tro' => 3, 'tai_khoan' => 'b1706712', 'password' => bcrypt('123456'), 'ten' => 'Lai Tuấn Kiệt', 'email' => 'anoskingpro1999@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822985', 'ma_don_vi' => 10, 'ngay_tao' => $today],

            ['ma' => 7, 'ma_vai_tro' => 4, 'tai_khoan' => 'vvtduc', 'password' => bcrypt('123456'), 'ten' => 'Võ Văn Tài Đức', 'email' => 'dragonkingpro1999@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822986', 'ma_don_vi' => 11, 'ngay_tao' => $today],
            ['ma' => 8, 'ma_vai_tro' => 4, 'tai_khoan' => 'tduy', 'password' => bcrypt('123456'), 'ten' => 'Thanh Duy', 'email' => 'tgkhanh1999@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822987', 'ma_don_vi' => 12, 'ngay_tao' => $today],

            ['ma' => 9, 'ma_vai_tro' => 2, 'tai_khoan' => 'cohuong', 'password' => bcrypt('123456'), 'ten' => 'Cô Hương', 'email' => 'oumashupro69@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822988', 'ma_don_vi' => 4, 'ngay_tao' => $today],
            ['ma' => 10, 'ma_vai_tro' => 2, 'tai_khoan' => 'cothu', 'password' => bcrypt('123456'), 'ten' => 'Cô Thư', 'email' => 'oumashupro0609@gmail.com', 'khoa_tai_khoan' => 0, 'so_dien_thoai' => '0939822989', 'ma_don_vi' => 5, 'ngay_tao' => $today],
        ]);
    }
}
