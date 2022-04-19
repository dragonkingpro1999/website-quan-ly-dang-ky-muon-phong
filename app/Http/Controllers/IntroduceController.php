<?php

namespace App\Http\Controllers;

use App\Models\Introduce;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class IntroduceController extends Controller
{
    protected $introduce;
    protected $decentralization;

    public function __construct(Introduce $introduce, Decentralization $decentralization)
    {
        $this->introduce = $introduce;
        $this->decentralization = $decentralization;
    }

    public function edit()
    {

        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật giới thiệu';
        $edit = $this->introduce->_get_by_id(1);

        if ($edit) {
            return view('pages.admin.introduce.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng liên hệ nhà phát triển");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        if ($request->noi_dung == "" || $request->tieu_de == "") {
            Session::put('error', "Nội dung hoặc tiêu đề không được rỗng");
            return redirect()->route('edit_introduce');
        }
        $update = $this->introduce->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật giới thiệu thành công");
            return redirect()->route('edit_introduce');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('edit_introduce');
        }
    }

    // public function check_name_is_unique(Request $request)
    // {
    //     return $this->introduce->_name_is_unique($request->name, $request->id);
    // }
}
