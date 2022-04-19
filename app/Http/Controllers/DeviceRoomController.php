<?php

namespace App\Http\Controllers;

use App\Models\DeviceRoom;
use App\Models\Device;
use App\Models\Room;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class DeviceRoomController extends Controller
{
    protected $device_room;
    protected $room;
    protected $device;

    public function __construct(DeviceRoom $device_room, Room $room, Device $device, Decentralization $decentralization)
    {
        $this->device_room = $device_room;
        $this->room = $room;
        $this->device = $device;
        $this->decentralization = $decentralization;
    }

    public function index($id)
    {
        $all = $this->device_room->_get_by_id_room_and_check_roles($id);
        if ($all) {
            if ($all === 'error_id_room') {
                Session::put('error', "Mã phòng không tồn tại hoặc Bạn không có quyền tại mã phòng này");
                return redirect()->route('room');
            }
            $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
            $title = 'Thiết bị phòng';

            $room = $this->room->_get_by_id($id);
            $device = $this->device->_get_all();
            return view('pages.admin.device_room.index', compact('all', 'room', 'device', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra! Vui lòng thử lại");
            return redirect()->route('room');
        }
    }


    public function insert(Request $request)
    {
        $insert = $this->device_room->_insert($request->except('_token', 'ma_phong', 'ma_thiet_bi'), $request->ma_phong);
        if ($insert) {
            Session::put('success', "Thêm thiết bị phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Thêm thiết bị phòng thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->device_room->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa thiết bị phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    public function deletes(Request $request)
    {
        $delete = $this->device_room->_deletes($request->except('_token'));
        if ($delete) {
            Session::put('success', "Xóa thiết bị phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $edit = $this->device_room->_get_by_id($request->id);
        return $edit;
    }

    public function update(Request $request)
    {
        $update = $this->device_room->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật thiết bị phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }
}
