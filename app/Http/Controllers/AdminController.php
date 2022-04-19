<?php

namespace App\Http\Controllers;

use App\Models\Decentralization;
use App\Models\NguoiDung;
use App\Models\BorrowRoom;
use App\Models\Room;
use App\Models\Uses;
use Illuminate\Http\Request;
use Auth;
use App\Exports\ReportExport_Danh_Sach_Muon_Phong;
use App\Exports\ReportExport_Danh_Sach_Muon_Phong_Pendding;
use App\Exports\ReportExport_Danh_Sach_Muon_Phong_Success;
use App\Exports\ReportExport_Danh_Sach_Muon_Phong_Destroy_By_Administrator;
use App\Exports\ReportExport_Danh_Sach_Muon_Phong_Destroy_By_Customer;
use App\Exports\ReportExport_Tan_Suat_Su_Dung_Phong;
use Excel;
use Session;

class AdminController extends Controller
{
    protected $decentralization;
    protected $borrow_room;
    protected $room;
    protected $nguoi_dung;
    protected $uses;

    public function __construct(Decentralization $decentralization, BorrowRoom $borrow_room, Room $room, NguoiDung $nguoi_dung, Uses $uses)
    {
        $this->decentralization = $decentralization;
        $this->borrow_room = $borrow_room;
        $this->room = $room;
        $this->nguoi_dung = $nguoi_dung;
        $this->uses = $uses;
    }

    public function index(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if (!isset($request->date_start)) {
            $date_start = date("Y-m-d", strtotime('monday this week -1 week'));
        } else {
            $date_start = $request->date_start;
        }
        if (!isset($request->date_end)) {
            $date_end = date("Y-m-d", strtotime('sunday this week -1 week'));
        } else {
            $date_end = $request->date_end;
        }



        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);



        $nguoi_dung = NguoiDung::get();
        $ma_nguoi_duyet = [];
        if ($request->ma_nguoi_duyet) {
            $ma_nguoi_duyet = $request->ma_nguoi_duyet;
        }
        $ma_nguoi_dung = [];
        if ($request->ma_nguoi_dung) {
            $ma_nguoi_dung = $request->ma_nguoi_dung;
        }
        $room = $this->room->_get_all();
        $room_ids = [];
        if ($request->room_ids) {
            $room_ids = $request->room_ids;
        }

        $uses = $this->uses->_get_all();
        $uses_ids = [];
        if ($request->uses_ids) {
            $uses_ids = $request->uses_ids;
        }
        $borrow_room_all =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '');


        $borrow_room_pendding =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '1');
        $borrow_room_success =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '2');
        $borrow_room_destroy_by_customer =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '3');
        $borrow_room_destroy_by_administrator =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '4');
        $sum_borrow_room = $borrow_room_pendding->count() + $borrow_room_success->count() + $borrow_room_destroy_by_customer->count() + $borrow_room_destroy_by_administrator->count();


        Session::put('excel_borrow_room_all', $borrow_room_all);
        Session::put('excel_borrow_room_pendding', $borrow_room_pendding);
        Session::put('excel_borrow_room_success', $borrow_room_success);
        Session::put('excel_borrow_room_destroy_by_customer', $borrow_room_destroy_by_customer);
        Session::put('excel_borrow_room_destroy_by_administrator', $borrow_room_destroy_by_administrator);

        return
            view(
                'pages.admin.index',
                compact(
                    'roles_user',
                    'date_start',
                    'date_end',
                    'borrow_room_pendding',
                    'borrow_room_success',
                    'borrow_room_destroy_by_customer',
                    'borrow_room_destroy_by_administrator',
                    'sum_borrow_room',
                    'borrow_room_all',
                    'nguoi_dung',
                    'ma_nguoi_duyet',
                    'ma_nguoi_dung',
                    'room',
                    'room_ids',
                    'uses',
                    'uses_ids'
                )
            );
    }

    public function chart(Request $request)
    {
        return  $this->borrow_room->_get_chart($request);
    }

    public function excel_borrow_room_all(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Danh_Sach_Muon_Phong(), 'Bao_cao_danh_sach_muon_phong' . $name . '.xlsx');
    }

    public function excel_borrow_room_pendding(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Danh_Sach_Muon_Phong_Pendding(), 'Bao_cao_danh_sach_su_dung_phong_dang_cho_duyet' . $name . '.xlsx');
    }

    public function excel_borrow_room_success(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Danh_Sach_Muon_Phong_Success(), 'Bao_cao_danh_sach_su_dung_phong_muon_thanh_cong' . $name . '.xlsx');
    }

    public function excel_borrow_room_destroy_by_customer(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Danh_Sach_Muon_Phong_Destroy_By_Customer(), 'Bao_cao_danh_sach_su_dung_phong_huy_boi_nguoi_dung' . $name . '.xlsx');
    }

    public function excel_borrow_room_destroy_by_administrator(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Danh_Sach_Muon_Phong_Destroy_By_Administrator(), 'Bao_cao_danh_sach_su_dung_phong_huy_boi_nha_quan_tri' . $name . '.xlsx');
    }

    public function excel_borrow_room_frequency_of_room_use(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        return Excel::download(new ReportExport_Tan_Suat_Su_Dung_Phong(), 'Bao_cao_tan_suat_su_dung_phong' . $name . '.xlsx');
    }
}
