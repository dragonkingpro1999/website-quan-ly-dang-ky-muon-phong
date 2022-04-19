<?php

namespace App\Http\Controllers;

use App\Models\Uses;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class UsesController extends Controller
{
    protected $uses;
    protected $decentralization;

    public function __construct(Uses $uses, Decentralization $decentralization)
    {
        $this->uses = $uses;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả chức năng';
        $all = $this->uses->_get_all();
        return view('pages.admin.uses.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm chức năng';
        return view('pages.admin.uses.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->uses->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm chức năng thành công");
            return redirect()->route('add_uses');
        } else {
            Session::put('error', "Tên bị trùng do có 2 người dùng cùng submit một lúc");
            return redirect()->route('add_uses');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->uses->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa chức năng thành công");
            return redirect()->route('uses');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('uses');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật chức năng';
        $edit = $this->uses->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.uses.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('uses');
        }
    }

    public function update(Request $request)
    {
        $update = $this->uses->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật chức năng thành công");
            return redirect()->route('uses');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('uses');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->uses->_name_is_unique($request->name, $request->id);
    }
}
