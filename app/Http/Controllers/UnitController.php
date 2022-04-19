<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class UnitController extends Controller
{
    protected $unit;
    protected $decentralization;

    public function __construct(Unit $unit, Decentralization $decentralization)
    {
        $this->unit = $unit;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả đơn vị';
        $all = $this->unit->_get_all();
        return view('pages.admin.unit.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm đơn vị';
        return view('pages.admin.unit.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->unit->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm đơn vị thành công");
            return redirect()->route('add_unit');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại");
            return redirect()->route('add_unit');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->unit->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa đơn vị thành công");
            return redirect()->route('unit');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('unit');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật đơn vị';
        $edit = $this->unit->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.unit.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('unit');
        }
    }

    public function update(Request $request)
    {
        $update = $this->unit->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật đơn vị thành công");
            return redirect()->route('unit');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('unit');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->unit->_name_is_unique($request->name, $request->id);
    }
}
