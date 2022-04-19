<?php

namespace App\Http\Controllers;

use App\Models\SettingBorrowRoom;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SettingBorrowRoomController extends Controller
{
    protected $setting_borrow_room;
    protected $decentralization;

    public function __construct(SettingBorrowRoom $setting_borrow_room, Decentralization $decentralization)
    {
        $this->setting_borrow_room = $setting_borrow_room;
        $this->decentralization = $decentralization;
    }



    public function delete(Request $request)
    {
        $delete = $this->setting_borrow_room->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa cài đặt thời gian đăng ký mượn phòng thành công");
            return redirect()->route('setting_borrow_room');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('setting_borrow_room');
        }
    }

    public function edit()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật cài đặt thời gian đăng ký mượn phòng';
        $edit = $this->setting_borrow_room->_get_by_id(1);
        if ($edit) {
            return view('pages.admin.setting_borrow_room.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $update = $this->setting_borrow_room->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật cài đặt thời gian đăng ký mượn phòng thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }
}
