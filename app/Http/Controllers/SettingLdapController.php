<?php

namespace App\Http\Controllers;

use App\Models\SettingLdap;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class SettingLdapController extends Controller
{
    protected $setting_ldap;
    protected $decentralization;

    public function __construct(SettingLdap $setting_ldap, Decentralization $decentralization)
    {
        $this->setting_ldap = $setting_ldap;
        $this->decentralization = $decentralization;
    }

    public function edit()
    {

        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật ldap';
        $edit = $this->setting_ldap->_get_by_id(1);

        if ($edit) {
            return view('pages.admin.setting_ldap.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng liên hệ nhà phát triển");
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $update = $this->setting_ldap->_update($request->except('_token', 'ma'), $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật ldap thành công");
            return redirect()->route('edit_setting_ldap');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('edit_setting_ldap');
        }
    }
}
