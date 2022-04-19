<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class cai_dat_gioi_thieu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('cai_dat_gioi_thieu')->insert([
            [
                'ma' => 1,
                'tieu_de' => 'Website đăng ký mượn phòng tại khoa Công Nghệ Thông Tin & Truyền Thông - Đại học Cần Thơ',
                'noi_dung' => 'Xây dựng website hỗ trợ đăng ký mượn phòng tại khoa Công Nghệ Thông Tin và Truyền Thông - Đại học Cần Thơ <br>
                            Website cung cấp phương tiện đăng ký mượn phòng học một cách nhanh chóng và tiện lợi, hỗ trợ xem thời khóa biểu của phòng học dễ dàng và mau lẹ',
                'ngay_tao' => $today
            ],
        ]);
    }
}
