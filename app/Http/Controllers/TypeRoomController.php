<?php

namespace App\Http\Controllers;

use App\Models\TypeRoom;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class TypeRoomController extends Controller
{
    protected $type_room;
    protected $decentralization;

    public function __construct(TypeRoom $type_room, Decentralization $decentralization)
    {
        $this->type_room = $type_room;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả loại phòng';
        $all = $this->type_room->_get_all();
        return view('pages.admin.type_room.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm loại phòng';
        return view('pages.admin.type_room.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->type_room->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm loại phòng thành công");
            return redirect()->route('add_type_room');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại");
            return redirect()->route('add_type_room');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->type_room->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa loại phòng thành công");
            return redirect()->route('type_room');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('type_room');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật loại phòng';
        $edit = $this->type_room->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.type_room.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('type_room');
        }
    }

    public function update(Request $request)
    {
        $update = $this->type_room->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật loại phòng thành công");
            return redirect()->route('type_room');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('type_room');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->type_room->_name_is_unique($request->name, $request->id);
    }
}
