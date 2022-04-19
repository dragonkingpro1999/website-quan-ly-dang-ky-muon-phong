<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\Unit;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class ManagerUserController extends Controller
{
    protected $nguoi_dung;
    protected $decentralization;
    protected $unit;

    public function __construct(NguoiDung $nguoi_dung, Decentralization $decentralization, Unit $unit)
    {
        $this->nguoi_dung = $nguoi_dung;
        $this->decentralization = $decentralization;
        $this->unit = $unit;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả tài khoản';
        $all = $this->nguoi_dung->_get_all_join_null();
        return view('pages.admin.manager_user.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm tài khoản';
        $vai_tro = DB::table('vai_tro')->get();
        $unit = $this->unit->_get_all();
        return view('pages.admin.manager_user.add', compact('title', 'vai_tro', 'roles_user', 'unit'));
    }

    public function insert(Request $request)
    {
        $insert = $this->nguoi_dung->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm tài khoản thành công");
            return redirect()->route('add_manager_user');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại");
            return redirect()->route('add_manager_user');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->nguoi_dung->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa tài khoản thành công");
            return redirect()->route('manager_user');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('manager_user');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật tài khoản';
        $edit = $this->nguoi_dung->_get_by_id($id);
        $unit = $this->unit->_get_all();
        if ($edit) {
            $vai_tro = DB::table('vai_tro')->get();
            return view('pages.admin.manager_user.edit', compact('edit', 'title', 'vai_tro', 'roles_user', 'unit'));
        } else {
            Session::put('error', "Mã tài khoản không tồn tại");
            return redirect()->route('manager_user');
        }
    }
    public function change_password($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thiết lập lại mật khẩu';
        $edit = $this->nguoi_dung->_get_by_id($id);
        if ($edit) {
            $vai_tro = DB::table('vai_tro')->get();
            return view('pages.admin.manager_user.change_password', compact('edit', 'title', 'vai_tro', 'roles_user'));
        } else {
            Session::put('error', "Mã tài khoản không tồn tại");
            return redirect()->route('manager_user');
        }
    }


    public function update(Request $request)
    {
        $update = $this->nguoi_dung->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật tài khoản thành công");
            return redirect()->route('manager_user');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('manager_user');
        }
    }

    public function up_change_password(Request $request)
    {
        $update = $this->nguoi_dung->_update_password($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Thiết lập lại mật khẩu thành công");
            return redirect()->route('edit_manager_user', ['id' => $request->ma]);
        } else {
            Session::put('error', "Thiết lập lại mật khẩu thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }



    public function check_username_is_unique(Request $request)
    {
        return $this->nguoi_dung->_username_is_unique($request->name, $request->id);
    }
}
