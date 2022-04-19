<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class quyen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('quyen')->insert([
            ['ma' => 1, 'url' => 'trang-chu', 'ten' => 'Trang chủ', 'mo_ta' => 'Quản lý trang chủ, thống kê, báo cáo', 'ngay_tao' => $today],
            ['ma' => 2, 'url' => 'loai-phong', 'ten' => 'Loại phòng', 'mo_ta' => 'Quản lý loại phòng', 'ngay_tao' => $today],
            ['ma' => 3, 'url' => 'chuc-nang', 'ten' => 'Chức năng', 'mo_ta' => 'Quản lý chức năng phòng', 'ngay_tao' => $today],
            ['ma' => 4, 'url' => 'thiet-bi', 'ten' => 'Thiết bị', 'mo_ta' => 'Quản lý thiết bị phòng', 'ngay_tao' => $today],
            ['ma' => 5, 'url' => 'phong', 'ten' => 'Phòng', 'mo_ta' => 'Quản lý phòng', 'ngay_tao' => $today],
            ['ma' => 6, 'url' => 'thoi-gian-mo-hoc-ky', 'ten' => 'Thời gian mở học kỳ', 'mo_ta' => 'Quản lý thời gian mở học kỳ', 'ngay_tao' => $today],
            ['ma' => 7, 'url' => 'quan-ly-tai-khoan', 'ten' => 'Tài khoản hệ thống', 'mo_ta' => 'Quản lý tài khoản hệ thống', 'ngay_tao' => $today],
            ['ma' => 8, 'url' => 'duyet-dang-ky', 'ten' => 'Duyệt đăng ký', 'mo_ta' => 'Quản lý duyệt đăng ký phòng', 'ngay_tao' => $today],
            ['ma' => 9, 'url' => 'phan-hoi-lien-he', 'ten' => 'Phản hồi liên hệ', 'mo_ta' => 'Phản hồi câu hỏi liên hệ', 'ngay_tao' => $today],
            ['ma' => 10, 'url' => 'cai-dat', 'ten' => 'Cài đặt website', 'mo_ta' => 'Cài đặt', 'ngay_tao' => $today],
            ['ma' => 11, 'url' => 'tin-tuc', 'ten' => 'Tin tức', 'mo_ta' => 'Quản lý tin tức', 'ngay_tao' => $today],
            ['ma' => 12, 'url' => 'phan-hoi-phong', 'ten' => 'Phản hồi phòng', 'mo_ta' => 'Quản lý phản hồi phòng', 'ngay_tao' => $today],
        ]);
    }
}
