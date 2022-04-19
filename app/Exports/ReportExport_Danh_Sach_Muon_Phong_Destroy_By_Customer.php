<?php

namespace App\Exports;

use App\Models\BorrowRoom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Session;

class ReportExport_Danh_Sach_Muon_Phong_Destroy_By_Customer implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'STT',
            'Người mượn',
            'Email',
            'Ngày đăng ký mượn',
            'Phòng mượn',
            'Ngày mượn',
            'TG. bd mượn',
            'TG. kt mượn',
            'Lý do mượn',
            'Chức năng sử dụng',
            'Ngày duyệt',
            'Người duyệt/hủy',
            'Email người duyệt/hủy',
            'Lý do hủy',
            'Trạng thái',
            'Tổng TG',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return BorrowRoom::all();
        $excel = Session::get('excel_borrow_room_destroy_by_customer');
        // dd($excel);
        $report[] = array(
            'STT',
            'Người mượn',
            'Email',
            'Ngày đăng ký mượn',
            'Phòng mượn',
            'Ngày mượn',
            'TG. BĐ. mượn',
            'TG. KT. mượn',
            'Lý do mượn',
            'Chức năng sử dụng',
            'Ngày duyệt',
            'Người duyệt/hủy',
            'Email người duyệt/hủy',
            'Lý do hủy',
            'Trạng thái',
            'Tổng TG',
        );
        foreach ($excel as $key => $value) {
            $trang_thai = '';
            if ($value->trang_thai == 1) {
                $trang_thai = 'Đang chờ duyệt';
            } else if ($value->trang_thai == 2) {
                $trang_thai = 'Mượn thành công';
            } else if ($value->trang_thai == 3) {
                $trang_thai = 'Hủy bởi người dùng';
            } else if ($value->trang_thai == 4) {
                $trang_thai = 'Hủy bởi người quản trị';
            }
            $hours = $this->differenceInHours($value->thoi_gian_bat_dau_muon, $value->thoi_gian_ket_thuc_muon);
            $gio = floor($hours);
            $phut = $hours - $gio;
            if ($gio == 0) {
                $phut = $phut * 60;
                $time = ($phut) . "'";
            } else if ($phut == 0) {
                $time = $gio . 'h';
            } else {
                $phut = $phut * 60;
                $time = $gio . 'h ' . ($phut) . "'";
            }
            $report[$key++] = array(
                'STT' => $key++,
                'Người mượn' => $value->ten_nguoi_dung,
                'Email' => $value->email_nguoi_dung,
                'Ngày đăng ký mượn' => $value->ngay_tao,
                'Phòng mượn' => $value->ten_phong,
                'Ngày mượn' => $value->ngay_muon,
                'TG. BĐ. mượn' => $value->thoi_gian_bat_dau_muon,
                'TG. KT. mượn' => $value->thoi_gian_ket_thuc_muon,
                'Lý do mượn' => $value->ly_do_muon,
                'Chức năng sử dụng' => $value->chuc_nang_su_dung,
                'Ngày duyệt' => $value->ngay_duyet,
                'Người duyệt/hủy' => $value->ten_nguoi_duyet,
                'Email người duyệt/hủy' => $value->email_nguoi_duyet,
                'Lý do hủy' => $value->ly_do_huy,
                'Trạng thái' => $trang_thai,
                'Tổng TG' => $time,
            );
        }

        return collect($report);
    }

    public function differenceInHours($startdate, $enddate)
    {
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = abs($endtimestamp - $starttimestamp) / 3600;
        return $difference;
    }
}
