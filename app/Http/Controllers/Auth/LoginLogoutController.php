<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;
use LdapRecord\Connection;
use LdapRecord\Auth\BindException;
use App\Models\NguoiDung;
use App\Models\SettingLdap;

class LoginLogoutController extends Controller
{
    protected $nguoi_dung;
    protected $setting_ldap;

    public function __construct(NguoiDung $nguoi_dung, SettingLdap $setting_ldap)
    {
        $this->nguoi_dung = $nguoi_dung;
        $this->setting_ldap = $setting_ldap;
    }

    public function login(Request $request)
    {
        $credentials = [
            'tai_khoan' => $request->tai_khoan,
            'password' => $request->password,
        ];
        // Tài khoản có trong hệ thống
        if (Auth::guard('nguoi_dung')->attempt($credentials)) {
            if (Auth::guard('nguoi_dung')->user()->khoa_tai_khoan == 1) {
                Auth::guard('nguoi_dung')->logout();
                Session::put('error', "Tài khoản của bạn bị khóa 1 chiều");
                return redirect()->route('login');
            }
            // nếu là admin -> trang admin
            if (Auth::guard('nguoi_dung')->user()->ma == '1') {
                return redirect()->route('home_admin');
            }
            return redirect()->route('home');
        } else {
            //Chứng thực ldap
            $ldap = $this->ldap($request->tai_khoan, $request->password);
            if ($ldap) {
                if ($user = NguoiDung::where('tai_khoan', $request->tai_khoan)->first()) {
                    $temp = $this->change_password($user, $request->password);
                } else {
                    $temp =  $this->create_user($ldap, $request->tai_khoan, $request->password);
                }
                //Đăng nhập
                if ($temp) {
                    Auth::guard('nguoi_dung')->attempt($credentials);
                    if (Auth::guard('nguoi_dung')->user()->khoa_tai_khoan == 1) {
                        Auth::guard('nguoi_dung')->logout();
                        Session::put('error', "Tài khoản của bạn bị khóa 1 chiều");
                        return redirect()->route('login');
                    }
                    // nếu là admin -> trang admin
                    if (Auth::guard('nguoi_dung')->user()->ma == '1') {
                        return redirect()->route('home_admin');
                    }
                    return redirect()->route('home');
                }
            } else {
                Session::put('error', "Tài khoản hoặc mật khẩu không chính xác");
                return redirect()->route('login');
            }
        }
    }




    public function logout()
    {
        Auth::guard('nguoi_dung')->logout();
        return redirect()->route('login');
    }

    public function change_password($user, $password)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $data['password'] = bcrypt($password);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $user->update($data);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function create_user($ldap, $tai_khoan, $password)
    {
        // dd($ldap, $ldap['sn'][0], $ldap['title'][0]);

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            if ($ldap['title'][0] == 'teacher') {

                $insert['ma_vai_tro'] = 2;
            } else {
                $insert['ma_vai_tro'] = 3;
            }

            $insert['tai_khoan'] = $tai_khoan;
            $insert['password'] = bcrypt($password);

            $insert['ten'] = $ldap['sn'][0];
            $insert['khoa_tai_khoan'] = 0;

            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            NguoiDung::create($insert);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    //   // Mandatory Configuration Options
    //   'hosts'            => ['127.0.0.1'],
    //   'base_dn'          => $user,
    //   'username'         => $user,
    //   'password'         => $password,

    //   // Optional Configuration Options
    //   'port'             => 10389,
    //   'use_ssl'          => false,
    //   'use_tls'          => false,
    //   'version'          => 3,
    //   'timeout'          => 5,
    //   'follow_referrals' => false,

    public function ldap($username, $password)
    {
        $user = 'cn=' . $username . ',ou=users,ou=system';

        $setting_ldap = $this->setting_ldap->_get_by_id(1);

        $connection = new Connection([
            // Mandatory Configuration Options
            'hosts'            => [$setting_ldap->hosts],
            'base_dn'          => $user,
            'username'         => $user,
            'password'         => $password,

            // Optional Configuration Options
            'port'             => $setting_ldap->port,
            'use_ssl'          => $setting_ldap->use_ssl ? true : false,
            'use_tls'          => $setting_ldap->use_tls ? true : false,
            'version'          => $setting_ldap->version,
            'timeout'          => $setting_ldap->timeout,
            'follow_referrals' => $setting_ldap->follow_referrals ? true : false,

            // Custom LDAP Options
            'options' => [
                // See: http://php.net/ldap_set_option
                // LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_HARD
            ]
        ]);

        try {
            // dd($connection->connect());
            $connection->connect();
            $results = $connection->query()->where('cn', '=', $username)->first();
            // dd($results['sn'][0]);
            // echo "Successfully connected!";
            return $results;
        } catch (BindException $e) {
            // $error = $e->getDetailedError();
            // echo $error->getErrorCode();
            // echo $error->getErrorMessage();
            // echo $error->getDiagnosticMessage();
            return false;
        }
    }
}
