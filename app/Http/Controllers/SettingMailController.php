<?php

namespace App\Http\Controllers;

use App\Models\SettingMail;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SettingMailController extends Controller
{
    protected $setting_mail;
    protected $decentralization;

    public function __construct(SettingMail $setting_mail, Decentralization $decentralization)
    {
        $this->setting_mail = $setting_mail;
        $this->decentralization = $decentralization;
    }

    public function edit()
    {

        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật mail gửi';
        $edit = $this->setting_mail->_get_by_id(1);

        if ($edit) {
            return view('pages.admin.setting_mail.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng liên hệ nhà phát triển");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $update = $this->setting_mail->_update($request->except('_token', 'ma'), $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật mail gửi thành công");
            return redirect()->route('edit_setting_mail');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('edit_setting_mail');
        }
    }

    // public function check_name_is_unique(Request $request)
    // {
    //     return $this->setting_mail->_name_is_unique($request->name, $request->id);
    // }
}
