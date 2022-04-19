<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class DeviceController extends Controller
{
    protected $device;
    protected $decentralization;

    public function __construct(Device $device, Decentralization $decentralization)
    {
        $this->device = $device;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả thiết bị';
        $all = $this->device->_get_all();
        return view('pages.admin.device.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm thiết bị';
        return view('pages.admin.device.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->device->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm thiết bị thành công");
            return redirect()->route('add_device');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại");
            return redirect()->route('add_device');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->device->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa thiết bị thành công");
            return redirect()->route('device');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('device');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật thiết bị';
        $edit = $this->device->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.device.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('device');
        }
    }

    public function update(Request $request)
    {
        $update = $this->device->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật thiết bị thành công");
            return redirect()->route('device');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('device');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->device->_name_is_unique($request->name, $request->id);
    }
}
