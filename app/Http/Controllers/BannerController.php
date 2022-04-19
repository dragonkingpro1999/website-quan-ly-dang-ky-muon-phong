<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class BannerController extends Controller
{
    protected $banner;
    protected $decentralization;

    public function __construct(Banner $banner, Decentralization $decentralization)
    {
        $this->banner = $banner;
        $this->decentralization = $decentralization;
    }

    public function edit()
    {

        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật băng rôn';
        $edit = $this->banner->_get_by_id(1);

        if ($edit) {
            return view('pages.admin.banner.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng liên hệ nhà phát triển");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $update = $this->banner->_update($request->except('_token', 'ma'), $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật băng rôn thành công");
            return redirect()->route('edit_banner');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('edit_banner');
        }
    }

    // public function check_name_is_unique(Request $request)
    // {
    //     return $this->banner->_name_is_unique($request->name, $request->id);
    // }
}
