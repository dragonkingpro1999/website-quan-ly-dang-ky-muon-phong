<?php

namespace App\Http\Controllers;

use App\Models\UsesRoom;
use App\Models\Uses;
use App\Models\Room;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class UsesRoomController extends Controller
{
    protected $uses_room;
    protected $room;
    protected $uses;
    protected $decentralization;

    public function __construct(UsesRoom $uses_room, Room $room, Uses $uses, Decentralization $decentralization)
    {
        $this->uses_room = $uses_room;
        $this->room = $room;
        $this->uses = $uses;
        $this->decentralization = $decentralization;
    }

    public function index($id)
    {
        $all = $this->uses_room->_get_by_id_room_and_check_roles($id);
        if ($all) {
            if ($all === 'error_id_room') {
                Session::put('error', "Mã phòng không tồn tại hoặc Bạn không có quyền tại mã phòng này");
                return redirect()->route('room');
            }
            $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
            $title = 'Chức năng phòng';

            $room = $this->room->_get_by_id($id);
            $uses = $this->uses->_get_all();
            return view('pages.admin.uses_room.index', compact('all', 'room', 'uses', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra! Vui lòng thử lại");
            return redirect()->route('room');
        }
    }


    public function insert(Request $request)
    {
        $insert = $this->uses_room->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm chức năng phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Thêm chức năng phòng thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->uses_room->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa chức năng phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    public function deletes(Request $request)
    {
        $delete = $this->uses_room->_deletes($request->except('_token'));
        if ($delete) {
            Session::put('success', "Xóa chức năng phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    public function get_uses_room(Request $request)
    {
        return $this->uses_room->_get_by_id_room($request->id);
    }
}
