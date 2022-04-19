<?php

namespace App\Http\Controllers;

use App\Models\TimeOpenSemester;
use App\Models\SchoolYear;
use App\Models\Semester;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class TimeOpenSemesterController extends Controller
{
    protected $time_open_semester;
    protected $decentralization;
    protected $school_year;
    protected $semester;

    public function __construct(TimeOpenSemester $time_open_semester, Decentralization $decentralization, SchoolYear $school_year, Semester $semester)
    {
        $this->time_open_semester = $time_open_semester;
        $this->decentralization = $decentralization;
        $this->school_year = $school_year;
        $this->semester = $semester;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thời gian mở học kỳ';
        $all = $this->time_open_semester->_get_all();
        return view('pages.admin.time_open_semester.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm thời gian mở học kỳ';
        $school_year = $this->school_year->_get_all();
        $semester = $this->semester->_get_all();
        return view('pages.admin.time_open_semester.add', compact('title', 'roles_user', 'school_year', 'semester'));
    }

    public function insert(Request $request)
    {
        $insert = $this->time_open_semester->_insert($request->except('_token'));
        if ($insert) {
            Session::put('success', "Thêm thời gian mở học kỳ thành công");
            return redirect()->route('add_time_open_semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('add_time_open_semester');
        }
    }

    public function delete(Request $request)
    {
        return  $this->time_open_semester->_delete($request->id);
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật thời gian mở học kỳ';
        $edit = TimeOpenSemester::find($id);
        $school_year = $this->school_year->_get_all();
        $semester = $this->semester->_get_all();
        if ($edit) {
            return view('pages.admin.time_open_semester.edit', compact('edit', 'title', 'roles_user', 'school_year', 'semester'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('time_open_semester');
        }
    }

    public function update(Request $request)
    {
        $update = $this->time_open_semester->_update($request->except('_token'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật thời gian mở học kỳ thành công");
            return redirect()->route('time_open_semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('time_open_semester');
        }
    }

    public function check_school_year__and_semester_is_unique(Request $request)
    {
        return $this->time_open_semester->check_school_year__and_semester_is_unique($request->ma_nam_hoc, $request->ma_hoc_ky, $request->id);
    }

    public function status($id)
    {
        $status = $this->time_open_semester->_status($id);
        if ($status) {
            $edit = $this->time_open_semester->_get_by_id($id);
            if ($edit->trang_thai) {
                Session::put('success', "Mở đăng ký thành công");
            } else {
                Session::put('success', "Đóng đăng ký thành công");
            }
            return redirect()->route('time_open_semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('time_open_semester');
        }
    }

    public function default($id)
    {
        $default = $this->time_open_semester->_default($id);
        if ($default) {
            Session::put('success', "Đặt làm mặc định thành công");
            return redirect()->route('time_open_semester');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng F5 và thử lại!");
            return redirect()->route('time_open_semester');
        }
    }
}
