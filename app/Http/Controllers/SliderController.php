<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SliderController extends Controller
{
    protected $slider;
    protected $decentralization;

    public function __construct(Slider $slider, Decentralization $decentralization)
    {
        $this->slider = $slider;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả thanh trượt';
        $all = $this->slider->_get_all();
        return view('pages.admin.slider.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm thanh trượt';
        return view('pages.admin.slider.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        $insert = $this->slider->_insert($request->except('_token'), $request);
        if ($insert) {
            Session::put('success', "Thêm thanh trượt thành công");
            return redirect()->route('add_slider');
        } else {
            Session::put('error', "Tên bị trùng do có 2 người dùng cùng submit một lúc");
            return redirect()->route('add_slider');
        }
    }

    public function delete(Request $request)
    {
        if ($this->slider->_get_all()->count() <= 1) {
            Session::put('error', "Bạn không được xóa hết tất cả!");
            return redirect()->route('slider');
        }
        $delete = $this->slider->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa thanh trượt thành công");
            return redirect()->route('slider');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('slider');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật thanh trượt';
        $edit = $this->slider->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.slider.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('slider');
        }
    }

    public function update(Request $request)
    {
        $update = $this->slider->_update($request->except('_token', 'ma'), $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật thanh trượt thành công");
            return redirect()->route('slider');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('slider');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->slider->_name_is_unique($request->name, $request->id);
    }
}
