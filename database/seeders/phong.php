<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class phong extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('phong')->insert([
            ['ma' => 1, 'ma_loai_phong' => 1, 'ten' => 'P01/DI', 'mo_ta' => 'Phòng máy tính 01', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_01.jpg', 'ngay_tao' => $today],
            ['ma' => 2, 'ma_loai_phong' => 1, 'ten' => 'P02/DI', 'mo_ta' => 'Phòng máy tính 02', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_02.jpg', 'ngay_tao' => $today],
            ['ma' => 3, 'ma_loai_phong' => 1, 'ten' => 'P03/DI', 'mo_ta' => 'Phòng máy tính 03', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_03.jpg',  'ngay_tao' => $today],
            ['ma' => 4, 'ma_loai_phong' => 1, 'ten' => 'P04/DI', 'mo_ta' => 'Phòng máy tính 04', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_04.jpg',  'ngay_tao' => $today],
            ['ma' => 5, 'ma_loai_phong' => 1, 'ten' => 'P05/DI', 'mo_ta' => 'Phòng máy tính 05', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_05.jpg',  'ngay_tao' => $today],

            ['ma' => 6, 'ma_loai_phong' => 1, 'ten' => 'P06/DI', 'mo_ta' => 'Phòng máy tính 06', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_06.jpg',  'ngay_tao' => $today],
            ['ma' => 7, 'ma_loai_phong' => 1, 'ten' => 'P07/DI', 'mo_ta' => 'Phòng máy tính 07', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_07.jpg',  'ngay_tao' => $today],
            ['ma' => 8, 'ma_loai_phong' => 1, 'ten' => 'P08/DI', 'mo_ta' => 'Phòng máy tính 08', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_08.jpg',  'ngay_tao' => $today],
            ['ma' => 9, 'ma_loai_phong' => 1, 'ten' => 'P09/DI', 'mo_ta' => 'Phòng máy tính 09', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_09.jpg',  'ngay_tao' => $today],
            ['ma' => 10, 'ma_loai_phong' => 1, 'ten' => 'P010/DI', 'mo_ta' => 'Phòng máy tính 10', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_10.jpg',  'ngay_tao' => $today],

            ['ma' => 11, 'ma_loai_phong' => 1, 'ten' => 'P011/DI', 'mo_ta' => 'Phòng máy tính 11', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_11.jpg', 'ngay_tao' => $today],
            ['ma' => 12, 'ma_loai_phong' => 1, 'ten' => 'P12/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 12 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_12.jpg', 'ngay_tao' => $today],
            ['ma' => 13, 'ma_loai_phong' => 1, 'ten' => 'P13/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 13 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_13.jpg',  'ngay_tao' => $today],
            ['ma' => 14, 'ma_loai_phong' => 1, 'ten' => 'P14/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 14 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_14.jpg',  'ngay_tao' => $today],
            ['ma' => 15, 'ma_loai_phong' => 1, 'ten' => 'P15/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 15 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_01.jpg',  'ngay_tao' => $today],

            ['ma' => 16, 'ma_loai_phong' => 1, 'ten' => 'P16/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 16 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_02.jpg',  'ngay_tao' => $today],
            ['ma' => 17, 'ma_loai_phong' => 1, 'ten' => 'P17/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 17 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_03.jpg',  'ngay_tao' => $today],
            ['ma' => 18, 'ma_loai_phong' => 1, 'ten' => 'P18/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 18 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_04.jpg',  'ngay_tao' => $today],
            ['ma' => 19, 'ma_loai_phong' => 1, 'ten' => 'P19 - CLC1/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính chất lượng cao 1 - Lầu 1', 'suc_chua' => 60, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_05.jpg',  'ngay_tao' => $today],
            ['ma' => 20, 'ma_loai_phong' => 1, 'ten' => 'P20 - CLC2/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính chất lượng cao 2 - Lầu 1', 'suc_chua' => 60, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_06.jpg',  'ngay_tao' => $today],

            ['ma' => 21, 'ma_loai_phong' => 1, 'ten' => 'P21 - CLC3/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính chất lượng cao 3 - Lầu 1', 'suc_chua' => 60, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'pc_07.jpg', 'ngay_tao' => $today],
            ['ma' => 22, 'ma_loai_phong' => 1, 'ten' => 'P22 - CLC4/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính chất lượng cao 4 - Lầu 1', 'suc_chua' => 60, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_08.jpg', 'ngay_tao' => $today],
            ['ma' => 23, 'ma_loai_phong' => 1, 'ten' => 'Phòng họp 2 - CLC5/DI - Lầu 1', 'mo_ta' => 'Phòng họp 2 - Chất lượng cao 5 - Lầu 1', 'suc_chua' => 100, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'phong_hop_01.jpg',  'ngay_tao' => $today],
            ['ma' => 24, 'ma_loai_phong' => 1, 'ten' => 'P23/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 23 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_01.jpg',  'ngay_tao' => $today],
            ['ma' => 25, 'ma_loai_phong' => 1, 'ten' => 'P24/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 24 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_02.jpg',  'ngay_tao' => $today],

            ['ma' => 26, 'ma_loai_phong' => 1, 'ten' => 'P25/DI - Lầu 1', 'mo_ta' => 'Phòng máy tính 25 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_03.jpg',  'ngay_tao' => $today],
            ['ma' => 27, 'ma_loai_phong' => 1, 'ten' => 'P01/NĐH - Lầu 7', 'mo_ta' => 'Phòng máy tính 01 - Nhà điều hành - Lầu 7', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_04.jpg',  'ngay_tao' => $today],
            ['ma' => 28, 'ma_loai_phong' => 1, 'ten' => 'P02/NĐH - Lầu 7', 'mo_ta' => 'Phòng máy tính 02 - Nhà điều hành - Lầu 7', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_05.jpg',  'ngay_tao' => $today],
            ['ma' => 29, 'ma_loai_phong' => 1, 'ten' => 'P03/NĐH - Lầu 7', 'mo_ta' => 'Phòng máy tính 03 - Nhà điều hành - Lầu 7', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_06.jpg',  'ngay_tao' => $today],
            ['ma' => 30, 'ma_loai_phong' => 1, 'ten' => 'P04/NĐH - Lầu 7', 'mo_ta' => 'Phòng máy tính 04 - Nhà điều hành - Lầu 7', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'lap_top_07.jpg',  'ngay_tao' => $today],



            ['ma' => 31, 'ma_loai_phong' => 2, 'ten' => 'LT1/DI - Lầu 1', 'mo_ta' => 'Phòng lý thuyết 01 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'ly_thuyet_01.jpg', 'ngay_tao' => $today],
            ['ma' => 32, 'ma_loai_phong' => 2, 'ten' => 'LT2/DI - Lầu 1', 'mo_ta' => 'Phòng lý thuyết 02 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'ly_thuyet_02.jpg', 'ngay_tao' => $today],
            ['ma' => 33, 'ma_loai_phong' => 2, 'ten' => 'LT3/DI - Lầu 1', 'mo_ta' => 'Phòng lý thuyết 03 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'ly_thuyet_03.jpg',  'ngay_tao' => $today],
            ['ma' => 34, 'ma_loai_phong' => 2, 'ten' => 'LT4/DI - Lầu 1', 'mo_ta' => 'Phòng lý thuyết 04 - Lầu 1', 'suc_chua' => 40, 'trang_thai' => true, 'hien_thi' => true, 'hinh_anh' => 'ly_thuyet_01.jpg',  'ngay_tao' => $today],
        ]);
    }
}
