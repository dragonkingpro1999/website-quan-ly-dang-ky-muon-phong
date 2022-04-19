<?php

namespace App\Http\Controllers;

use App\Models\ManagerRoleRoom;
use App\Models\NguoiDung;
use App\Models\Room;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class RoleRoomController extends Controller
{
    protected $role;
    protected $room;
    protected $nguoi_dung;
    protected $decentralization;

    public function __construct(ManagerRoleRoom $role, Room $room, NguoiDung $nguoi_dung, Decentralization $decentralization)
    {
        $this->role = $role;
        $this->room = $room;
        $this->nguoi_dung = $nguoi_dung;
        $this->decentralization = $decentralization;
    }

    public function index($id)
    {
        $all = $this->role->_get_by_id_room_and_check_roles($id);

        if ($all) {
            if ($all === 'error_id_room') {
                Session::put('error', "Mã phòng không tồn tại hoặc Bạn không có quyền tại mã phòng này");
                return redirect()->route('room');
            }
            $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
            $title = 'Phân quyền phòng';

            $room = $this->room->_get_by_id($id);
            $nguoi_dung = $this->nguoi_dung->_get_all();
            return view('pages.admin.role_room.index', compact('all', 'room', 'nguoi_dung', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra! Vui lòng thử lại");
            return redirect()->route('room');
        }
    }


    public function insert(Request $request)
    {
        $insert = $this->role->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm phân quyền phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Thêm phân quyền phòng thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->role->_delete_but_update($request->id);
        if ($delete) {
            // if ($delete == 'error_role_delete') {
            //     Session::put('error', "Bạn chỉ có thể xóa quyền do tự mình cấp");
            //     return redirect()->back();
            // }
            Session::put('success', "Xóa phân quyền phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    public function deletes(Request $request)
    {
        $delete = $this->role->_deletes($request->except('_token'));
        if ($delete) {
            Session::put('success', "Xóa phân quyền phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    // public function get_role(Request $request)
    // {
    //     return $this->role->_get_by_id_room($request->id);
    // }
}
