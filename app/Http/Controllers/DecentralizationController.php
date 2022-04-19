<?php

namespace App\Http\Controllers;

use App\Models\Decentralization;
use App\Models\NguoiDung;
use App\Models\ManagerRoleRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class DecentralizationController extends Controller
{
    protected $decentralization;
    protected $nguoi_dung;
    protected $manager_role_room;
    protected $room;

    public function __construct(Decentralization $decentralization, NguoiDung $nguoi_dung, ManagerRoleRoom $manager_role_room, Room $room)
    {
        $this->decentralization = $decentralization;
        $this->nguoi_dung = $nguoi_dung;
        $this->manager_role_room = $manager_role_room;
        $this->room = $room;
    }

    public function index($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Phân quyền tài khoản';
        $all = $this->decentralization->_get_by_id_user($id);
        $nguoi_dung = $this->nguoi_dung->_get_by_id($id);
        $manager_role_room = $this->manager_role_room->_get_by_id_user($id);
        $room = $this->room->_get_all_orderby_ma();
        $role = DB::table('quyen')->get();
        if ($all && $nguoi_dung) {
            return view('pages.admin.decentralization.index', compact('all', 'title', 'nguoi_dung', 'room', 'manager_role_room', 'role', 'roles_user'));
        } else {
            Session::put('error', "Mã người dùng không hợp lệ");
            return redirect()->route('manager_user');
        }
    }

    public function update(Request $request)
    {
        // dd($request);
        $update = $this->decentralization->_update($request->phan_quyen, $request->phan_quyen_phong, $request->ma_nguoi_dung);
        if ($update) {
            Session::put('success', "Cập nhật quyền thành công");
            return redirect()->route('decentralization', ['id' => $request->ma_nguoi_dung]);
        } else {
            Session::put('error', "Cập nhật thất bại. Vui lòng thử lại");
            return redirect()->route('decentralization', ['id' => $request->ma_nguoi_dung]);
        }
    }
}
