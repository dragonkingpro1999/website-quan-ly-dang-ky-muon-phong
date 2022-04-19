<?php

namespace App\Http\Controllers;

use App\Models\TypeRoom;
use App\Models\Uses;
use App\Models\Device;
use App\Models\UsesRoom;
use App\Models\DeviceRoom;
use App\Models\Room;
use App\Models\RoleBorrowRoom;
use App\Models\Decentralization;
use App\Models\ManagerRoleRoom;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class RoomController extends Controller
{
    protected $room;
    protected $type_room;
    protected $uses;
    protected $device;
    protected $role_borrow_room;
    protected $decentralization;
    protected $manager_role_room;
    protected $feed_back;

    public function __construct(Room $room, TypeRoom $type_room, Uses $uses, Device $device, RoleBorrowRoom $role_borrow_room, UsesRoom $uses_room, DeviceRoom $device_room, Decentralization $decentralization, ManagerRoleRoom $manager_role_room, FeedBack $feed_back)
    {
        $this->room = $room;
        $this->type_room = $type_room;
        $this->uses = $uses;
        $this->device = $device;
        $this->device_room = $device_room;
        $this->uses_room = $uses_room;
        $this->role_borrow_room = $role_borrow_room;
        $this->decentralization = $decentralization;
        $this->manager_role_room = $manager_role_room;
        $this->feed_back = $feed_back;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả phòng';
        $all = $this->room->_get_all_by_role_room();
        return view('pages.admin.room.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm phòng';
        $type_room = $this->type_room->_get_all();
        return view('pages.admin.room.add', compact('type_room', 'title', 'roles_user'));
    }

    public function insert(Request $request)
    {

        if ($request->trang_thai == "1") {
            $request->trang_thai = true;
        } else {
            $request->trang_thai = false;
        }

        if ($request->hien_thi == "1") {
            $request->hien_thi = true;
        } else {
            $request->hien_thi = false;
        }

        $insert_room = $request->except('_token', '1', '2', '3', '4');
        $insert_role_room = $request->except('_token', 'ten', 'ma_loai_phong', 'suc_chua', 'trang_thai', 'hien_thi', 'vi_tri', 'mo_ta', 'hinh_anh');
        $insert = $this->room->_insert($insert_room, $insert_role_room, $request);
        if ($insert) {
            Session::put('success', "Thêm phòng thành công");
            return redirect()->route('add_room');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại");
            return redirect()->route('add_room');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->room->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa phòng thành công");
            return redirect()->route('room');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('room');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật phòng';
        $type_room = $this->type_room->_get_all();
        $edit = $this->room->_get_by_id_and_check_roles($id);
        $edit_role_room = $this->role_borrow_room->_get_by_id_room($id);
        if ($edit) {
            if ($edit === 'error_id_room') {
                Session::put('error', "Mã phòng không tồn tại hoặc Bạn không có quyền tại mã phòng này");
                return redirect()->route('room');
            }
            return view('pages.admin.room.edit', compact('edit', 'type_room', 'edit_role_room', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('room');
        }
    }

    public function update(Request $request)
    {

        if ($request->trang_thai == "1") {
            $request->trang_thai = true;
        } else {
            $request->trang_thai = false;
        }

        if ($request->hien_thi == "1") {
            $request->hien_thi = true;
        } else {
            $request->hien_thi = false;
        }

        $update_room = $request->except('_token', '1', '2', '3', '4', 'hinh_anh');
        $update_role_room = $request->except('_token', 'ten', 'ma_loai_phong', 'suc_chua', 'trang_thai', 'hien_thi', 'vi_tri', 'mo_ta', 'ma', 'hinh_anh');
        $update = $this->room->_update($update_room, $update_role_room, $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật phòng thành công");
            return redirect()->route('room');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('room');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->room->_name_is_unique($request->name, $request->id);
    }

    public function get_infor(Request $request)
    {
        $room = $this->room->_get_infor($request->id);
        $device_room = $this->device_room->_get_by_id_room($request->id);
        $uses_room = $this->uses_room->_get_by_id_room($request->id);
        $role_borrow_room = $this->role_borrow_room->_get_by_id_room($request->id);
        $room->device_room = $device_room;
        $room->uses_room = $uses_room;
        $room->role_borrow_room = $role_borrow_room;
        $room->manager_role_room = $this->manager_role_room->_get_infor_user_manager_room($request->id);
        $room->feed_back = $this->feed_back->_get_feed_back($request->id);;
        return $room;
    }

    public function get_room_by_role_borrow(Request $request)
    {
        $room = $this->room->_get_room_by_role_borrow($request->id);
        // $device_room = $this->device_room->_get_by_id_room($request->id);
        // $uses_room = $this->uses_room->_get_by_id_room($request->id);
        // $room->device_room = $device_room;
        // $room->uses_room = $uses_room;

        return $room;
    }
}
