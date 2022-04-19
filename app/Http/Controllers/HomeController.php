<?php

namespace App\Http\Controllers;

use App\Models\TypeRoom;
use App\Models\Uses;
use App\Models\Device;
use App\Models\Room;
use App\Models\RoleBorrowRoom;
use App\Models\TimeOpenSemester;
use App\Models\BorrowRoom;
use App\Models\Introduce;
use App\Models\ContactSetting;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\SettingBorrowRoom;
use App\Models\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;

use PDF;

class HomeController extends Controller
{
    protected $room;
    protected $type_room;
    protected $uses;
    protected $device;
    protected $role_borrow_room;
    protected $time_open_semester;
    protected $borrow_room;
    protected $introduce;
    protected $contact_setting;
    protected $banner;
    protected $slider;
    protected $news;

    public function __construct(Room $room, TypeRoom $type_room, Uses $uses, Device $device, RoleBorrowRoom $role_borrow_room, TimeOpenSemester $time_open_semester, BorrowRoom $borrow_room, Introduce $introduce, ContactSetting $contact_setting, Banner $banner, Slider $slider, News $news)
    {
        $this->room = $room;
        $this->type_room = $type_room;
        $this->uses = $uses;
        $this->device = $device;
        $this->role_borrow_room = $role_borrow_room;
        $this->time_open_semester = $time_open_semester;
        $this->borrow_room = $borrow_room;
        $this->introduce = $introduce;
        $this->contact_setting = $contact_setting;
        $this->banner = $banner;
        $this->slider = $slider;
        $this->news = $news;
    }

    public function index_borrow_room(Request $request)
    {
        // dd($request);
        $search_name_room = $request->search_name_room ? $request->search_name_room : null;
        $search_type_room = $request->search_type_room ? $request->search_type_room : null;
        $search_uses = $request->search_uses ? $request->search_uses : null;
        $search_device = $request->search_device ? $request->search_device : null;
        //Search
        $list_room = $this->room->_search_room($request->search_name_room, $request->search_type_room, $request->search_uses, $request->search_device);
        //Get infor
        // $list_room = $this->room->_get_all();
        if (isset($request->ma_time_open_semester)) {
            $time_open_semester = $this->time_open_semester->_get_by_id($request->ma_time_open_semester);
            $all_time_open_semester = $this->time_open_semester->_get_all();
            $time_start =  $time_open_semester->thoi_gian_bat_dau;
            $time_end =  $time_open_semester->thoi_gian_ket_thuc;
        } else {
            $time_open_semester = $this->time_open_semester->_get_date_default();
            $all_time_open_semester = $this->time_open_semester->_get_all();
            $time_start =  $time_open_semester->thoi_gian_bat_dau;
            $time_end =  $time_open_semester->thoi_gian_ket_thuc;
        }
        $time_open_semester_can_min = $this->time_open_semester->_get_time_open_semester_can_min();
        $time_open_semester_can_max = $this->time_open_semester->_get_time_open_semester_can_max();

        $time_open_signup = $this->time_open_semester->_get_time_open_signup();

        $device = $this->device->_get_all();
        $uses = $this->uses->_get_all();
        $type_room = $this->type_room->_get_all();

        if (isset($request->date_start) && isset($request->date_end)) {
            $thu_hai_cua_tuan_dau_tien = date_format(date_create($request->date_start), "Y-m-d");
            $chu_nhat_cua_tuan_dau_tien = date_format(date_create($request->date_end), "Y-m-d");
        } else {
            $ngay_bd = date_format(date_create($time_start), "d");
            $thang_bd = date_format(date_create($time_start), "m");
            $nam_bd = date_format(date_create($time_start), "Y");
            $thu_hai_cua_tuan_dau_tien = date("Y-m-d", mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd));
            $chu_nhat_cua_tuan_dau_tien = date("Y-m-d", mktime(0, 0, 0, $thang_bd, $ngay_bd + 6, $nam_bd));
        }
        $borrow_room = $this->borrow_room->_get_by_date_in_home($thu_hai_cua_tuan_dau_tien, $chu_nhat_cua_tuan_dau_tien);


        $setting_borrow_room = SettingBorrowRoom::find(1);



        if (isset($request->date_start) && isset($request->date_end)) {
            $paging_ngay_bd = $request->date_start;
            $paging_ngay_kt = $request->date_end;

            $pdf = [];
            $pdf = [
                'list_room' => $list_room,
                'time_start' => $time_start,
                'time_end' => $time_end,
                'borrow_room' => $borrow_room,
                'paging_ngay_bd' => $paging_ngay_bd,
                'paging_ngay_kt' => $paging_ngay_kt,
            ];

            Session::put('pdf', $pdf);
            return view('pages.home.borrow_room.index', compact('setting_borrow_room', 'time_open_signup', 'time_open_semester_can_max', 'time_open_semester_can_min', 'all_time_open_semester', 'time_open_semester', 'search_name_room', 'search_type_room', 'search_uses', 'search_device', 'uses', 'device', 'type_room', 'list_room', 'time_start', 'time_end', 'borrow_room', 'paging_ngay_bd', 'paging_ngay_kt'));
        }

        $pdf = [];
        $pdf = [
            'list_room' => $list_room,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'borrow_room' => $borrow_room,
            'paging_ngay_bd' => '',
            'paging_ngay_kt' => '',
        ];

        Session::put('pdf', $pdf);

        return view('pages.home.borrow_room.index', compact('setting_borrow_room', 'time_open_signup', 'time_open_semester_can_max', 'time_open_semester_can_min', 'all_time_open_semester', 'time_open_semester', 'search_name_room', 'search_type_room', 'search_uses', 'search_device', 'uses', 'device', 'type_room', 'list_room', 'time_start', 'borrow_room', 'time_end'));
    }

    public function index_borrow_room_lt(Request $request)
    {
        $request->search_type_room = 2;
        return $this->index_borrow_room($request);
    }

    public function index_borrow_room_th(Request $request)
    {
        $request->search_type_room = 1;
        return $this->index_borrow_room($request);
    }




    public function index()
    {
        $introduce = $this->introduce->_get_by_id(1);
        $contact_setting = $this->contact_setting->_get_by_id(1);
        $banner = $this->banner->_get_by_id(1);
        $slider = $this->slider->_get_all();
        $news = $this->news->_get_all_and_check_status();
        return view('pages.home.home.index', compact('introduce', 'contact_setting', 'banner', 'slider', 'news'));
    }

    public function data_pdf()
    {
        $data = Session::get('pdf');
        // dd($data);
        $time_start = $data['time_start'];
        $time_end = $data['time_end'];
        $list_room = $data['list_room'];
        $borrow_room = $data['borrow_room'];
        if (($data['paging_ngay_bd'] != "") && ($data['paging_ngay_kt'] != "")) {
            $paging_ngay_bd = $data['paging_ngay_bd'];
            $paging_ngay_kt = $data['paging_ngay_kt'];
            return view('pages.home.borrow_room.data_pdf', compact('time_start', 'time_end', 'list_room', 'borrow_room', 'paging_ngay_bd', 'paging_ngay_kt'));
        }

        return view('pages.home.borrow_room.data_pdf', compact('time_start', 'time_end', 'list_room', 'borrow_room'));
    }

    public function download_pdf()
    {

        $data = Session::get('pdf');
        if (!$data) {
            return "Chưa có dữ liệu xuất file pdf";
        }
        $time_start = $data['time_start'];
        $time_end = $data['time_end'];
        $list_room = $data['list_room'];
        $borrow_room = $data['borrow_room'];

        if (($data['paging_ngay_bd'] != "") && ($data['paging_ngay_kt'] != "")) {
            $paging_ngay_bd = $data['paging_ngay_bd'];
            $paging_ngay_kt = $data['paging_ngay_kt'];
            $pdf = PDF::loadView('pages.home.borrow_room.data_pdf', compact('time_start', 'time_end', 'list_room', 'borrow_room', 'paging_ngay_bd', 'paging_ngay_kt'));
        } else {
            $pdf = PDF::loadView('pages.home.borrow_room.data_pdf', compact('time_start', 'time_end', 'list_room', 'borrow_room'));
        }

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $name = date('_Y_m_d_H_i_s');
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->download('Lich_muon_phong' . $name . '.pdf');
    }

    public function index_news()
    {
        $news = News::where('trang_thai', 1)->orderBy('ma', 'desc')->paginate(5);
        return view('pages.home.home.index_news', compact('news'));
    }

    public function index_news_info($id)
    {
        $news = News::where('trang_thai', 1)->where('ma', $id)->first();
        if (!$news) {
            return redirect()->route('home');
        }
        return view('pages.home.home.index_news_info', compact('news'));
    }
}
