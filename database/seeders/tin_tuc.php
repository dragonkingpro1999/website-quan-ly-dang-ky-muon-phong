<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class tin_tuc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        $today = "2021-05-10 08:00:00";
        DB::table('tin_tuc')->insert([
            [
                'ma' => 1,
                'hinh_anh' => 'tin_tuc_1.jpg',
                'tieu_de' => 'Lễ Kết thúc Dự án Hỗ trợ kỹ thuật - Giai đoạn 1 (TC1)',
                'noi_dung' => 'Ngày 24/11/2021, Trường Đại học Cần Thơ tổ chức Lễ kết thúc Dự án Hỗ trợ kỹ thuật (Technical Cooperation - TC) nhằm đánh dấu sự thành công của Dự án và ghi nhận, tri ân những đóng góp quan trọng của các thành viên trong Dự án JICA tại Trường Đại học Cần Thơ (JICA-CTU). Tham dự lễ có GS. Tsunoda Manabu, Cố vấn trưởng Dự án TC, ông Kunimoto Kazuhiko, Điều phối viên Dự án; GS. Ishimatsu Atsushi, Cố vấn học thuật của Dự án cùng các thành viên Văn phòng Dự án JICA tại Trường Đại học Cần Thơ. Về phía Trường Đại học Cần Thơ có GS.TS. Nguyễn Thanh Phương, Chủ tịch Hội đồng trường; GS.TS. Hà Thanh Toàn, Hiệu trưởng; các Phó Hiệu trưởng, Ban điều phối các lĩnh vực trong Dự án và các thành viên Ban Quản lý Dự án.',
                'trang_thai' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 2,
                'hinh_anh' => 'tin_tuc_2.jpg',
                'tieu_de' => 'Hội thảo lần thứ 42 về Viễn thám Khu vực Châu Á (ACRS2021)',
                'noi_dung' => 'Từ ngày 22 đến 24/11/2021, Trường Đại học Cần Thơ đăng cai tổ chức Hội thảo lần thứ 42 về Viễn thám Khu vực Châu Á (Asian Conference on Remote Sensing - ACRS2021) bằng hính thức trực tuyến qua phần mềm zoom với sự tham gia của 195 đại biểu đại diện lãnh đạo các cơ quan, tổ chức, các nhà khoa học, nhóm nghiên cứu, nhà quản lý đến từ khắp nơi trên thế giới như: Ấn Độ, Đài Loan, Hàn Quốc, Hoa Kỳ, Hong Kong, Indonesia, Malaysia, Mông Cổ, Myanmar, Nam Phi, Nga, Nhật Bản, Philippines, Singapore, Sri Lanka, Thái Lan, Thổ Nhĩ Kỳ, Trung Quốc và Việt Nam.',
                'trang_thai' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 3,
                'hinh_anh' => 'tin_tuc_3.jpg',
                'tieu_de' => 'Trường Đại học Cần Thơ mừng ngày Nhà giáo Việt Nam 20/11',
                'noi_dung' => 'Chào mừng 39 năm Ngày Nhà Giáo Việt Nam, nhằm tạo không khí vừa là ngày lễ vừa là giao lưu học hỏi kinh nghiệm, tạo sân chơi bổ ích, ý nghĩa cho thầy cô giáo và cán bộ ngành giáo dục, ngày 19/11/2021, Ban Thường vụ Công đoàn Trường Đại học Cần Thơ (ĐHCT) phối hợp với Công đoàn Giáo dục Tỉnh Bà Rịa Vũng Tàu tổ chức buổi sinh hoạt mừng ngày Nhà giáo Việt Nam 20/11 bằng hình thức trực tuyến qua phần mềm zoom.

                Tham dự buổi sinh hoạt có viên chức, người lao động của Trường ĐHCT và Công đoàn Giáo dục Tỉnh Bà Rịa Vũng Tàu; học sinh, sinh viên, học viên của Trường ĐHCT. Đặc biệt, chương trình có sự tham gia của Công đoàn Giáo dục của 63 tỉnh, thành phố trong cả nước; Công đoàn các đại học, trường đại học, trường cao đẳng, trường trung học. ',
                'trang_thai' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 4,
                'hinh_anh' => 'tin_tuc_4.jpg',
                'tieu_de' => 'Lễ Công bố Quyết định thành lập Đảng bộ Khoa Phát triển Nông thôn',
                'noi_dung' => 'Chiều ngày 18/11/2021, Trường Đại học Cần Thơ (ĐHCT) tổ chức Lễ Công bố Quyết định thành lập Đảng bộ Khoa Phát triển Nông thôn. Tham dự Lễ có Đ/c Nguyễn Thanh Phương, Bí thư Đảng ủy, Chủ tịch Hội đồng trường; Đ/c Hà Thanh Toàn, Phó Bí thư Đảng ủy, Hiệu trưởng; Đ/c Lê Phi Hùng, Phó Bí thư Đảng ủy; các đồng chí trong Ban Thường vụ Đảng ủy, đại diện các Ban Xây dựng Đảng, Văn phòng Đảng ủy; Công đoàn, Đoàn Thanh niên, các tổ chức Đảng trực thuộc Đảng bộ trường. Về phía Khoa Phát triển Nông thôn có các đồng chí trong Chi ủy, lãnh đạo các đoàn thể, bộ môn, văn phòng khoa và các đảng viên trong Chi bộ.',
                'trang_thai' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 5,
                'hinh_anh' => 'tin_tuc_5.jpg',
                'tieu_de' => 'Trường Đại học Cần Thơ sẵn sàng cho đợt đánh giá từ xa lần thứ 252 của AUN-QA đối với 4 chương trình đào tạo',
                'noi_dung' => 'Trong năm 2021, Trường Đại học Cần Thơ (ĐHCT) đăng ký đánh giá ngoài 8 chương trình đào tạo trình độ đại học (CTĐT) theo tiêu chuẩn của Mạng lưới đảm bảo chất lượng giáo dục của các trường đại học Đông Nam Á (AUN-QA). Theo đó, 4 CTĐT đã thực hiện đánh giá ngoài vào tháng 3/2021 và được công nhận đạt chuẩn chất lượng AUN-QA gồm: (1) Kỹ thuật phần mềm, (2) Mạng máy tính và Truyền thông dữ liệu (thuộc Khoa Công nghệ Thông tin và Truyền thông), (3) Kỹ thuật Cơ điện tử (thuộc Khoa Công nghệ), và (4) Sư phạm Toán học (thuộc Khoa Sư phạm).',
                'trang_thai' => true,
                'ngay_tao' => $today
            ],
            [
                'ma' => 6,
                'hinh_anh' => 'tin_tuc_6.jpg',
                'tieu_de' => 'Trao học bổng "Tỏa sáng cùng ADG" năm học 2021-2022',
                'noi_dung' => 'Nhằm khuyến khích sinh viên có hoàn cảnh khó khăn nhưng vươn lên trong cuộc sống, ngày 5/11/2021, Công ty ADG đã phối hợp cùng Trường Đại học Cần Thơ (ĐHCT) tổ chức Lễ trao học bổng "Tỏa sáng cùng ADG" năm học 2021-2022 với hình thức trực tuyến. Tại buổi lễ, đại diện Công ty ADG đã gửi tặng 08 suất học bổng cho các em sinh viên có hoàn cảnh khó khăn và có kết quả học tập Khá/Giỏi ở Trường ĐHCT.',
                'trang_thai' => false,
                'ngay_tao' => $today
            ],
        ]);
    }
}
