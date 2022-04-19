<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class muon_phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Trạng thái 1: Đang chờ duyệt
        // Trạng thái 2: Mượn thành công
        // Trạng thái 3: Hủy bởi người dùng
        // Trạng thái 4: Hủy bởi Admin
        $today = "2021-05-10 08:00:00";
        // 31/5 -25/7
        // tháng 6 mượn phòng
        $ma = 0;
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                //Thực hành
                if (($i == 2 || $i == 6) && ($j == 1 || $j == 4 || $j == 8 || $j == 11 || $j == 15 || $j == 18 || $j == 22 || $j == 25 || $j == 29)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:00:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 5 || $i == 10) && ($j == 2 || $j == 5 || $j == 9 || $j == 12 || $j == 16 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }

                //Lý thuyết
                if (($i == 31) && ($j == 3 || $j == 7 || $j == 10 || $j == 14 || $j == 17 || $j == 21 || $j == 24 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-30 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 33) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22 || $j == 26 || $j == 29)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 17 || $i == 18) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22 || $j == 26 || $j == 29)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '10:30:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 20 || $i == 21) && ($j == 3 || $j == 7 || $j == 10 || $j == 14 || $j == 17 || $j == 21 || $j == 24 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 12 || $i == 13) && ($j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '15:30:0', 'thoi_gian_ket_thuc_muon' => '17:30:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 25) && ($j == 21 || $j == 24 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-06-' . $j, 'thoi_gian_bat_dau_muon' => '09:30:0', 'thoi_gian_ket_thuc_muon' => '11:00:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }

        //tháng 7 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 31; $j++) {
                //Thực hành
                if (($i == 2 || $i == 6) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:00:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 5 || $i == 10) && ($j == 3 || $j == 7 || $j == 10 || $j == 14 || $j == 17 || $j == 21 || $j == 24)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }
                //Lý thuyết

                if (($i == 31) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 23)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 33) && ($j == 3 || $j == 6 || $j == 10  || $j == 13 || $j == 17 || $j == 20 || $j == 24)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 17 || $i == 18) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 15:00:00'
                        ],
                    ]);
                }

                if (($i == 20 || $i == 21) && ($j == 3 || $j == 7 || $j == 10 || $j == 14)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 19:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 12 || $i == 13) && ($j == 2 || $j == 5 || $j == 9)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '15:30:0', 'thoi_gian_ket_thuc_muon' => '17:30:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 25) && ($j == 3 || $j == 7)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-07-' . $j, 'thoi_gian_bat_dau_muon' => '09:30:0', 'thoi_gian_ket_thuc_muon' => '11:00:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }
        $ma++;
        DB::table('muon_phong')->insert([
            ['ma' => $ma, 'ma_phong' => 31, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-05-31', 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:45:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-30 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'],
        ]);



        // tháng 8 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                //Thực hành
                if (($i == 3 || $i == 7) && ($j == 2 || $j == 5 || $j == 9 || $j == 12 || $j == 16 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:10:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 6 || $i == 11) && ($j == 3 || $j == 6 || $j == 10 || $j == 13 || $j == 17 || $j == 20 || $j == 24 || $j == 27 || $j == 31)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }

                //Lý thuyết
                if (($i == 32) && ($j == 3 || $j == 7 || $j == 10 || $j == 14 || $j == 17 || $j == 21 || $j == 24 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:45:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-30 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 34) && ($j == 1 || $j == 5 || $j == 6 || $j == 12 || $j == 13 || $j == 19 || $j == 20 || $j == 26 || $j == 27)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 12 || $i == 15) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '10:30:0', 'thoi_gian_ket_thuc_muon' => '11:40:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 23) && ($j == 5 || $j == 9 || $j == 12 || $j == 16 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:45:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 14 || $i == 16) && ($j == 24 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '15:55:0', 'thoi_gian_ket_thuc_muon' => '17:40:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 25 || $i == 26) && ($j == 11 || $j == 14 || $j == 18)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-08-' . $j, 'thoi_gian_bat_dau_muon' => '09:55:0', 'thoi_gian_ket_thuc_muon' => '11:10:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }

        //tháng 9 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 31; $j++) {
                //Thực hành
                if (($i == 2 || $i == 6) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:00:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 5 || $i == 10) && ($j == 3 || $j == 7 || $j == 10 || $j == 14 || $j == 17 || $j == 21 || $j == 24 || $j == 25 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }
                //Lý thuyết

                if (($i == 34) && ($j == 1 || $j == 4 || $j == 8 || $j == 11 || $j == 15 || $j == 18 || $j == 23 || $j == 28 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 32) && ($j == 3 || $j == 6 || $j == 10  || $j == 13 || $j == 17 || $j == 20 || $j == 24 || $j == 25 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:30:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 12 || $i == 13) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '11:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 15:00:00'
                        ],
                    ]);
                }

                if (($i == 23 || $i == 25) && ($j == 3 || $j == 7 || $j == 10 || $j == 14)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:30:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 19:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 15 || $i == 13) && ($j == 2 || $j == 5 || $j == 9)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '15:30:0', 'thoi_gian_ket_thuc_muon' => '17:30:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 26) && ($j == 3 || $j == 7)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-09-' . $j, 'thoi_gian_bat_dau_muon' => '09:30:0', 'thoi_gian_ket_thuc_muon' => '11:00:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }

        // tháng 10 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                //Thực hành
                if (($i == 1 || $i == 11) && ($j == 2 || $j == 5 || $j == 9 || $j == 12 || $j == 16 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '07:45:0', 'thoi_gian_ket_thuc_muon' => '10:10:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 9 || $i == 14) && ($j == 1 || $j == 6 || $j == 8 || $j == 13 || $j == 15 || $j == 20 || $j == 22 || $j == 27 || $j == 29)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '13:15:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }

                //Lý thuyết
                if (($i == 31) && ($j == 2 || $j == 7 || $j == 9 || $j == 14 || $j == 16 || $j == 21 || $j == 23 || $j == 28)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '07:15:0', 'thoi_gian_ket_thuc_muon' => '11:45:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-30 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 33) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22 || $j == 26 || $j == 29)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '13:15:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 7 || $i == 17) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '9:45:0', 'thoi_gian_ket_thuc_muon' => '11:40:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 25 || $i == 26) && ($j == 5 || $j == 9 || $j == 12 || $j == 16 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '07:35:0', 'thoi_gian_ket_thuc_muon' => '09:45:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 3 || $i == 18) && ($j == 24 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '14:55:0', 'thoi_gian_ket_thuc_muon' => '17:40:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 23 || $i == 24) && ($j == 11 || $j == 14 || $j == 18)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-10-' . $j, 'thoi_gian_bat_dau_muon' => '07:55:0', 'thoi_gian_ket_thuc_muon' => '11:10:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }

        //tháng 11 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 31; $j++) {
                //Thực hành
                if (($i == 3 || $i == 13) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23 || $j == 27 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 4 || $i == 8) && ($j == 3 || $j == 5 || $j == 10 || $j == 12 || $j == 17 || $j == 19 || $j == 24 || $j == 26)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }
                //Lý thuyết

                if (($i == 33) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 23 || $j == 26 || $j == 30)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:45:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 32) && ($j == 3 || $j == 6 || $j == 10  || $j == 13 || $j == 17 || $j == 20 || $j == 24 || $j == 27)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:55:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 16 || $i == 6) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '11:55:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 15:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 26) && ($j == 3 || $j == 7 || $j == 10 || $j == 14)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:45:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 19:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 15 || $i == 2) && ($j == 2 || $j == 5 || $j == 9)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '15:30:0', 'thoi_gian_ket_thuc_muon' => '17:45:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 25) && ($j == 3 || $j == 7)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-11-' . $j, 'thoi_gian_bat_dau_muon' => '09:30:0', 'thoi_gian_ket_thuc_muon' => '11:15:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }


        //tháng 12 mượn phòng
        for ($i = 1; $i <= 34; $i++) {
            for ($j = 1; $j <= 31; $j++) {
                //Thực hành
                if (($i == 3 || $i == 13) && ($j == 2 || $j == 6 || $j == 9 || $j == 13 || $j == 16 || $j == 20 || $j == 23)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '3', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '07:30:0', 'thoi_gian_ket_thuc_muon' => '10:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '2', 'ly_do_muon' => 'Dạy Java', 'ngay_duyet' => '2021-05-31 08:00:00', 'ngay_tao' => '2021-05-29 07:00:00'
                        ],
                    ]);
                }

                if (($i == 4 || $i == 8) && ($j == 3 || $j == 1 || $j == 10 || $j == 8 || $j == 17 || $j == 15 || $j == 24 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '2', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '13:30:0', 'thoi_gian_ket_thuc_muon' => '16:50:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '7', 'ly_do_muon' => 'Dạy C#', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 13:00:00'
                        ],
                    ]);
                }
                //Lý thuyết

                if (($i == 33) && ($j == 3 || $j == 1 || $j == 10 || $j == 8 || $j == 17 || $j == 15 || $j == 24 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '10', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '08:00:0', 'thoi_gian_ket_thuc_muon' => '11:45:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Vi tích phân', 'ngay_duyet' => '2021-05-31 09:00:00', 'ngay_tao' => '2021-05-28 07:00:00'
                        ],
                    ]);
                }

                if (($i == 32) && ($j == 3 || $j == 6 || $j == 10  || $j == 13 || $j == 17 || $j == 20 || $j == 24)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '9', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '14:30:0', 'thoi_gian_ket_thuc_muon' => '16:55:0', 'trang_thai' => 2, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '13', 'ly_do_muon' => 'Dạy Lập trình căn bản', 'ngay_duyet' => '2021-05-31 10:00:00', 'ngay_tao' => '2021-05-27 13:00:00'
                        ],
                    ]);
                }

                //Hủy bởi người dung
                if (($i == 16 || $i == 6) && ($j == 1 || $j == 5 || $j == 8 || $j == 12 || $j == 15 || $j == 19 || $j == 22)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '8', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '11:55:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Đi công tác đột xuất', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 15:00:00'
                        ],
                    ]);
                }

                if (($i == 24 || $i == 26) && ($j == 3 || $j == 7 || $j == 10 || $j == 14)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '7', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '08:30:0', 'thoi_gian_ket_thuc_muon' => '09:45:0', 'trang_thai' => 3, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Đi công tác', 'ngay_duyet' => '2021-05-27 19:00:00', 'ngay_tao' => '2021-05-26 19:00:00'
                        ],
                    ]);
                }

                //Hủy bởi nhà quản trị
                if (($i == 15 || $i == 2) && ($j == 2 || $j == 5 || $j == 9)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '5', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '15:30:0', 'thoi_gian_ket_thuc_muon' => '17:45:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '3', 'ly_do_muon' => 'Dạy JavaScript', 'ly_do_huy' => 'Phòng đang kiểm tra chất lượng', 'ngay_duyet' => '2021-05-30 18:00:00', 'ngay_tao' => '2021-05-29 16:00:00'
                        ],
                    ]);
                }

                if (($i == 25) && ($j == 3 || $j == 7)) {
                    $ma++;
                    DB::table('muon_phong')->insert([
                        [
                            'ma' => $ma, 'ma_phong' => $i, 'ma_nguoi_dung' => '6', 'ngay_muon' => '2021-12-' . $j, 'thoi_gian_bat_dau_muon' => '09:30:0', 'thoi_gian_ket_thuc_muon' => '11:15:0', 'trang_thai' => 4, 'ma_nguoi_duyet' => 1, 'chuc_nang' => '4', 'ly_do_muon' => 'Dạy Php', 'ly_do_huy' => 'Phòng vừa bị hư hôm qua, đang tiến hành sữa chữa', 'ngay_duyet' => '2021-05-31 17:00:00', 'ngay_tao' => '2021-05-27 15:00:00'
                        ],
                    ]);
                }
            }
        }
    }
}
