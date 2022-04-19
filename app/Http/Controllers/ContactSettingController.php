<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class ContactSettingController extends Controller
{
    protected $contact_setting;
    protected $decentralization;

    public function __construct(ContactSetting $contact_setting, Decentralization $decentralization)
    {
        $this->contact_setting = $contact_setting;
        $this->decentralization = $decentralization;
    }

    public function edit()
    {

        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật giới thiệu';
        $edit = $this->contact_setting->_get_by_id(1);

        if ($edit) {
            return view('pages.admin.contact_setting.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng liên hệ nhà phát triển");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $update = $this->contact_setting->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật giới thiệu thành công");
            return redirect()->route('edit_contact_setting');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('edit_contact_setting');
        }
    }

    // public function check_name_is_unique(Request $request)
    // {
    //     return $this->contact_setting->_name_is_unique($request->name, $request->id);
    // }
}
