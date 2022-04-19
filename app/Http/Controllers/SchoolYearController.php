<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SchoolYearController extends Controller
{
    protected $school_year;
    protected $decentralization;

    public function __construct(SchoolYear $school_year, Decentralization $decentralization)
    {
        $this->school_year = $school_year;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả năm học';
        $all = $this->school_year->_get_all();
        return view('pages.admin.school_year.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm năm học';
        return view('pages.admin.school_year.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->school_year->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm năm học thành công");
            return redirect()->route('add_school_year');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('add_school_year');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->school_year->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa năm học thành công");
            return redirect()->route('school_year');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('school_year');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật năm học';
        $edit = $this->school_year->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.school_year.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('school_year');
        }
    }

    public function update(Request $request)
    {
        $update = $this->school_year->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật năm học thành công");
            return redirect()->route('school_year');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('school_year');
        }
    }

    public function check_school_year_is_unique(Request $request)
    {
        return $this->school_year->_school_year_is_unique($request->nam_dau, $request->nam_sau, $request->id);
    }
}
