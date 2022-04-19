<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Decentralization;
use App\Models\ManagerRoleRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $decentralization;


    public function __construct(Decentralization $decentralization)
    {
        $this->decentralization = $decentralization;
    }

    public function handle(Request $request, Closure $next)
    {
        // dd(2);
        $_url = "$_SERVER[REQUEST_URI]";
        $_temp = "@@!!@@";
        $_url = "^^^^^^" . $_temp . $_url;
        $_temp = $_temp . "/admin/";

        if (Auth::guard('nguoi_dung')->guest()) {
            Session::put('error', "Bạn chưa đăng nhập hoặc tài khoản quá hạn");
            return redirect()->route('login');
        }

        $id = Auth::guard('nguoi_dung')->user()->ma;

        $roles = $this->decentralization->_get_by_id_user($id);
        // dd($roles);
        foreach ($roles as $key => $value) {
            $ok = strpos($_url, $_temp . $value->url);
            if ($ok && $value->co_quyen == 1) {
                return $next($request);
            }
            if ($value->ma_quyen == '8') {
                $count = ManagerRoleRoom::where('ma_nguoi_dung', $id)->where('co_quyen', '1')->count();
                if ($count > 0) {
                    return $next($request);
                }
            }
        }
        // dd(1);
        // Auth::guard('nguoi_dung')->logout();
        Session::put('error', "Bạn KHÔNG có quyền truy cập");
        return redirect()->route('login');
    }
}
