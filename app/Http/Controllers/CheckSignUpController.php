<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRoom;
use App\Models\Room;
use App\Models\Uses;
use App\Models\Decentralization;
use App\Models\NguoiDung;
use Auth;
use Session;
use Exception;

class CheckSignUpController extends Controller
{
    protected $borrow_room;
    protected $decentralization;
    protected $room;
    protected $nguoi_dung;
    protected $uses;

    public function __construct(BorrowRoom $borrow_room, Decentralization $decentralization, Room $room, NguoiDung $nguoi_dung, Uses $uses)
    {
        $this->borrow_room = $borrow_room;
        $this->decentralization = $decentralization;
        $this->room = $room;
        $this->nguoi_dung = $nguoi_dung;
        $this->uses = $uses;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Duyệt đăng ký mượn phòng';
        $all = $this->borrow_room->_get_by_date_and_check_status_1();
        // dd($all);
        return view('pages.admin.check_signup_borrow_room.index', compact('all', 'title', 'roles_user'));
    }

    public function all(Request $request)
    {
        // $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả mượn phòng';
        // $all = $this->borrow_room->_get_by_date_and_check_status_all();
        // // dd($all);
        // return view('pages.admin.check_signup_borrow_room.all', compact('all', 'title', 'roles_user'));
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
        $all =  $this->borrow_room->_get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, '');

        return
            view(
                'pages.admin.check_signup_borrow_room.all',
                compact(
                    'roles_user',
                    'date_start',
                    'date_end',
                    'all',
                    'nguoi_dung',
                    'ma_nguoi_duyet',
                    'ma_nguoi_dung',
                    'room',
                    'room_ids',
                    'uses',
                    'uses_ids',
                    'title',
                )
            );
    }

    public function infor_signup_borrow_room($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thông tin mượn phòng';

        try {
            $info = $this->borrow_room->_get_infor_user_borrow_room($id);
        } catch (Exception $th) {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->back();
        }
        return view('pages.admin.check_signup_borrow_room.infor_signup', compact('info', 'title', 'roles_user'));
    }


    public function check_borrow_room(Request $request)
    {
        try {
            $this->borrow_room->_check_borrow_room($request->id);
            Session::put('success', "Duyệt đăng ký thành công");
            return redirect()->back();
        } catch (Exception $th) {
            Session::put('error', "Có lỗi xảy ra vui lòng thử lại");
            return redirect()->back();
        }
    }

    public function destroy_borrow_room(Request $request)
    {
        try {
            $this->borrow_room->_destroy_borrow_room($request->id, $request->ly_do_huy);
            Session::put('success', "Đã hủy và không cho mượn thành công");
            return redirect()->back();
        } catch (Exception $th) {
            Session::put('error', "Có lỗi xảy ra vui lòng thử lại");
            return redirect()->back();
        }
    }
}
