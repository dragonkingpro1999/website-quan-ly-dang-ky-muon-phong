<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SemesterController extends Controller
{
    protected $semester;
    protected $decentralization;

    public function __construct(Semester $semester, Decentralization $decentralization)
    {
        $this->semester = $semester;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả học kỳ';
        $all = $this->semester->_get_all();
        return view('pages.admin.semester.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm học kỳ';
        return view('pages.admin.semester.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->semester->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm học kỳ thành công");
            return redirect()->route('add_semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('add_semester');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->semester->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa học kỳ thành công");
            return redirect()->route('semester');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('semester');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật học kỳ';
        $edit = $this->semester->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.semester.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('semester');
        }
    }

    public function update(Request $request)
    {
        $update = $this->semester->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật học kỳ thành công");
            return redirect()->route('semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('semester');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->semester->_name_is_unique($request->name, $request->id);
    }
}
