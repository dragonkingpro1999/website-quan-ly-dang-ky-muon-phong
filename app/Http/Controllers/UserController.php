<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\Decentralization;
use App\Models\ManagerRoleRoom;
use App\Models\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class UserController extends Controller
{
    protected $nguoi_dung;
    protected $decentralization;
    protected $manager_role_room;
    protected $room;

    public function __construct(NguoiDung $nguoi_dung, Decentralization $decentralization, ManagerRoleRoom $manager_role_room, Room $room)
    {
        $this->nguoi_dung = $nguoi_dung;
        $this->decentralization = $decentralization;
        $this->manager_role_room = $manager_role_room;
        $this->room = $room;
    }

    public function infor()
    {
        $title = "Thông tin tài khoản";
        $user_id = Auth::guard('nguoi_dung')->user()->ma;
        $user = $this->nguoi_dung->_get_by_id($user_id);

        return view('pages.home.user.infor', compact('user', 'title'));
    }

    public function edit()
    {
        $title = "Cập nhật thông tin tài khoản";
        $user_id = Auth::guard('nguoi_dung')->user()->ma;
        $user = $this->nguoi_dung->_get_by_id($user_id);
        return view('pages.home.user.edit', compact('user', 'title'));
    }
    public function change_password()
    {
        $title = "Đổi mật khẩu";
        $user_id = Auth::guard('nguoi_dung')->user()->ma;
        $user = $this->nguoi_dung->_get_by_id($user_id);
        return view('pages.home.user.change_password', compact('user', 'title'));
    }
    public function update(Request $request)
    {
        $update = $this->nguoi_dung->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Cập nhật thông tin thành công");
            return redirect()->route('infor_user_home');
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('infor_user_home');
        }
    }
    public function up_change_password(Request $request)
    {
        $update = $this->nguoi_dung->_update_password($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Đổi mật khẩu thành công!");
            return redirect()->route('infor_user_home');
        } else {
            Session::put('error', "Đổi mật khẩu thất bại. Vui lòng thử lại");
            return redirect()->route('infor_user_home');
        }
    }


    public function role()
    {
        $id = Auth::guard('nguoi_dung')->user()->ma;
        $title = 'Quyền tài khoản';
        $all = $this->decentralization->_get_by_id_user($id);
        $nguoi_dung = $this->nguoi_dung->_get_by_id($id);
        $manager_role_room = $this->manager_role_room->_get_by_id_user($id);
        $room = $this->room->_get_all_orderby_ma();
        $role = DB::table('quyen')->get();

        return view('pages.home.user.role', compact('all', 'title', 'nguoi_dung', 'room', 'manager_role_room', 'role'));
    }

    public function check_email_is_unique(Request $request)
    {
        return $this->nguoi_dung->_email_is_unique($request->name, $request->id);
    }

    public function check_phone_is_unique(Request $request)
    {
        return $this->nguoi_dung->_phone_is_unique($request->name, $request->id);
    }

    public function check_password_old(Request $request)
    {

        if (!isset($request->name)) {
            return -1;
        }
        if (!Auth::guard('nguoi_dung')->check()) {
            return 1;
        }

        $credentials = [
            'tai_khoan' =>  $data['ma_nguoi_duyet'] = Auth::guard('nguoi_dung')->user()->tai_khoan,
            'password' => $request->name,
        ];
        if (Auth::guard('nguoi_dung')->attempt($credentials)) {
            if (Auth::guard('nguoi_dung')->user()->khoa_tai_khoan == 1) {
                return 1;
            }
            return -1;
        }
        return 1;
    }
}
