<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Models\RoleBorrowRoom;
use App\Models\TimeOpenSemester;
use App\Models\Uses;
use App\Models\Room;
use App\Models\Decentralization;
use App\Models\ManagerRoleRoom;
use App\Models\SettingBorrowRoom;
use App\Models\SettingMail;
use App\Models\FeedBack;
use Mail;
use Illuminate\Support\Facades\Session;

class BorrowRoom extends Model
{
    use HasFactory;

    protected $table = 'muon_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_phong',
        'ma_nguoi_dung',
        'chuc_nang',
        'ly_do_muon',
        'ngay_muon',
        'thoi_gian_bat_dau_muon',
        'thoi_gian_ket_thuc_muon',
        'ma_nguoi_duyet',
        'ngay_duyet',
        'trang_thai',
        'ly_do_huy',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'muon_phong.*',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _insert($insert)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            return $this->create($insert);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _delete($id)
    {
        try {
            $delete = $this->find($id);
            return $delete->delete();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _update($data, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            return $update->update($data);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _check_borrow_room($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ma_nguoi_duyet'] = Auth::guard('nguoi_dung')->user()->ma;
            $data['trang_thai'] = 2;
            $data['ngay_duyet'] = date('Y-m-d H:i:s');
            $update->update($data);

            $infor = $this->_get_infor_user_borrow_room($id);
            $email_nguoi_dung = NguoiDung::find($infor->ma_nguoi_dung)->email;
            $ten_nguoi_dung = NguoiDung::find($infor->ma_nguoi_dung)->ten;
            $mail = [
                'title' => "Đăng ký mượn phòng thành công",
                'ten_phong' => $infor->ten_phong,
                'mo_ta_phong' => $infor->mo_ta_phong,
                'ngay_muon' => $infor->ngay_muon,
                'tg_bd_muon' => $infor->thoi_gian_bat_dau_muon,
                'tg_kt_muon' => $infor->thoi_gian_bat_dau_muon,
                'trang_thai' => $infor->trang_thai,
                'ly_do_muon' => $infor->ly_do_muon,
                'chuc_nang_su_dung' => $infor->chuc_nang_su_dung,
                'ten_nguoi_duyet' => $infor->ten_nguoi_duyet,
                'email_nguoi_duyet' => $infor->email_nguoi_duyet,
                'so_dien_thoai_nguoi_duyet' => $infor->so_dien_thoai_nguoi_duyet,
            ];

            $info = [
                'title' => 'Đăng ký mượn phòng thành công',
                'to_mail' => $email_nguoi_dung,
                'to_name' => $ten_nguoi_dung
            ];

            $this->send_mail_admin($mail, 'pages.email.mail_success_sign_up_borrow_room', $info);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function _destroy_borrow_room($id, $ly_do_huy)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ma_nguoi_duyet'] = Auth::guard('nguoi_dung')->user()->ma;
            $data['trang_thai'] = 4;
            $data['ngay_duyet'] = date('Y-m-d H:i:s');
            $data['ly_do_huy'] = $ly_do_huy;
            $update->update($data);

            $infor = $this->_get_infor_user_borrow_room($id);
            $email_nguoi_dung = NguoiDung::find($infor->ma_nguoi_dung)->email;
            $ten_nguoi_dung = NguoiDung::find($infor->ma_nguoi_dung)->ten;
            $mail = [
                'title' => "Bạn bị hủy đăng ký mượn phòng bởi người quản trị",
                'ten_phong' => $infor->ten_phong,
                'mo_ta_phong' => $infor->mo_ta_phong,
                'ngay_muon' => $infor->ngay_muon,
                'tg_bd_muon' => $infor->thoi_gian_bat_dau_muon,
                'tg_kt_muon' => $infor->thoi_gian_bat_dau_muon,
                'trang_thai' => $infor->trang_thai,
                'ly_do_muon' => $infor->ly_do_muon,
                'chuc_nang_su_dung' => $infor->chuc_nang_su_dung,
                'ten_nguoi_duyet' => $infor->ten_nguoi_duyet,
                'email_nguoi_duyet' => $infor->email_nguoi_duyet,
                'so_dien_thoai_nguoi_duyet' => $infor->so_dien_thoai_nguoi_duyet,
                'ly_do_huy' => $infor->ly_do_huy,
            ];
            $info = [
                'title' => 'Đăng ký mượn phòng bị hủy',
                'to_mail' => $email_nguoi_dung,
                'to_name' => $ten_nguoi_dung
            ];
            $this->send_mail_admin($mail, 'pages.email.mail_success_sign_up_borrow_room', $info);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function send_mail_admin($data, $email_blade_php, $info)
    {

        $mail_setting = $this->_get_setting_mail();
        if ($info['to_mail'] != '') {
            Mail::send($email_blade_php, $data, function ($message) use ($info, $mail_setting) {
                $message->from($mail_setting->email, $mail_setting->ten);
                $message->to($info['to_mail'], $info['to_name']);
                $message->subject($info['title'] . ' #' . rand(1000, 9999));
            });
        }
    }

    public function _get_by_id($id)
    {
        try {
            return $this->find($id);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_by_date($date_start, $date_end)
    {
        return $this->where('ngay_muon', '>=', $date_start)
            ->where('ngay_muon', '<=', $date_end)
            ->select(
                'muon_phong.*',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_borrow_room($date_start, $date_end, $status)
    {
        return $this
            ->where('muon_phong.ngay_muon', '>=', $date_start)
            ->where('muon_phong.ngay_muon', '<=', $date_end)
            ->where('muon_phong.trang_thai', $status)
            ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
            ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
            ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
            ->select(
                'muon_phong.*',
                'muon_phong.ngay_muon as temp_ngay_muon',
                'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                'nguoi_dung.ten as ten_nguoi_dung',
                'nguoi_dung.email as email_nguoi_dung',
                'vai_tro.ten as ten_vai_tro',
                'vai_tro.mo_ta as mo_ta_vai_tro',
                'nguoi_duyet.ten as ten_nguoi_duyet',
                'nguoi_duyet.email as email_nguoi_duyet',
                'phong.ten as ten_phong',
                'phong.mo_ta as mo_ta_phong',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->orderBy('muon_phong.ngay_muon', 'asc')
            ->get();
    }

    public function _get_borrow_room_all($date_start, $date_end, $ma_nguoi_dung, $ma_nguoi_duyet, $room_ids, $uses_ids, $status)
    {
        $query =  $this
            ->where('muon_phong.ngay_muon', '>=', $date_start)
            ->where('muon_phong.ngay_muon', '<=', $date_end);
        if ($ma_nguoi_dung != []) {
            $query->whereIn('muon_phong.ma_nguoi_dung', $ma_nguoi_dung);
        }
        if ($ma_nguoi_duyet != []) {
            $query->whereIn('muon_phong.ma_nguoi_duyet', $ma_nguoi_duyet);
        }
        if ($room_ids != []) {
            $query->whereIn('muon_phong.ma_phong', $room_ids);
        }

        if ($status != "") {
            $query->where('muon_phong.trang_thai', $status);
        }
        $data = $query
            ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
            ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
            ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
            ->select(
                'muon_phong.*',
                'muon_phong.ngay_muon as temp_ngay_muon',
                'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                'nguoi_dung.ten as ten_nguoi_dung',
                'nguoi_dung.email as email_nguoi_dung',
                'vai_tro.ten as ten_vai_tro',
                'vai_tro.mo_ta as mo_ta_vai_tro',
                'nguoi_duyet.ten as ten_nguoi_duyet',
                'nguoi_duyet.email as email_nguoi_duyet',
                'phong.ten as ten_phong',
                'phong.mo_ta as mo_ta_phong',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_duyet,"%H:%i %d-%m-%Y")) as ngay_duyet'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->orderBy('muon_phong.ngay_muon', 'asc')
            ->get();
        foreach ($data as $key => $value) {
            if ($value->chuc_nang) {
                $chuc_nang = $value->chuc_nang;
                $list_chuc_nang = explode(",", $chuc_nang);
                $chuc_nang_su_dung = "";
                foreach ($list_chuc_nang as $key => $value1) {

                    //Lọc chức năng
                    if ($uses_ids != []) {
                        foreach ($uses_ids as $key => $value2) {
                            if ($value2 == $value1) {
                                $value->loc_chuc_nang = true;
                                break;
                            }
                        }
                    }

                    $uses = Uses::where('ma', $value1)->first();
                    $chuc_nang_su_dung .= $uses->ten;
                    $chuc_nang_su_dung .= '; ';
                }
                $chuc_nang_su_dung = substr($chuc_nang_su_dung, 0, strlen($chuc_nang_su_dung) - 2);
                $value->chuc_nang_su_dung = $chuc_nang_su_dung;
            } else {
                $value->chuc_nang_su_dung = null;
            }

            $value->feed_back = FeedBack::where('ma_muon_phong', $value->ma)->first();
        }
        if ($uses_ids != []) {
            foreach ($data as $key => $value) {
                if ($value->loc_chuc_nang != true) {
                    unset($data[$key]);
                }
            }
        }


        return $data;
    }

    public function _get_by_date_and_check_status_1()
    {

        $ma_user = Auth::guard('nguoi_dung')->user()->ma;
        $quyen_duyet_dang_ky = Decentralization::where('ma_nguoi_dung', $ma_user)->where('ma_quyen', '8')->first();
        if ($quyen_duyet_dang_ky->co_quyen == '1') {
            return
                $this->where('muon_phong.trang_thai', '1')
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
                ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'muon_phong.*',
                    'muon_phong.ngay_muon as temp_ngay_muon',
                    'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'nguoi_dung.email as email_nguoi_dung',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    'nguoi_duyet.ten as ten_nguoi_duyet',
                    'nguoi_duyet.email as email_nguoi_duyet',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->orderBy('muon_phong.ngay_muon', 'asc')
                ->get();
        } else {
            $manager_role = ManagerRoleRoom::where('ma_nguoi_dung', $ma_user)->get();
            $role = [];
            foreach ($manager_role as $key => $value) {
                if ($value->co_quyen == '1') {
                    $role[$key] = $value->ma_phong;
                }
            }
            return
                $this->whereIn('muon_phong.ma_phong', $role)
                ->where('muon_phong.trang_thai', '1')
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
                ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'muon_phong.*',
                    'muon_phong.ngay_muon as temp_ngay_muon',
                    'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'nguoi_dung.email as email_nguoi_dung',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    'nguoi_duyet.ten as ten_nguoi_duyet',
                    'nguoi_duyet.email as email_nguoi_duyet',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->orderBy('muon_phong.ngay_muon', 'asc')
                ->get();
        }
    }

    public function _get_by_date_and_check_status_all()
    {
        $ma_user = Auth::guard('nguoi_dung')->user()->ma;
        if ($ma_user == '1') {
            return
                $this
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
                ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'muon_phong.*',
                    'muon_phong.ngay_muon as temp_ngay_muon',
                    'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'nguoi_dung.email as email_nguoi_dung',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    'nguoi_duyet.ten as ten_nguoi_duyet',
                    'nguoi_duyet.email as email_nguoi_duyet',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->orderBy('muon_phong.ngay_muon', 'desc')
                ->get();
        } else {
            return
                $this
                ->where('ma_nguoi_duyet', $ma_user)
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
                ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'muon_phong.*',
                    'muon_phong.ngay_muon as temp_ngay_muon',
                    'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'nguoi_dung.email as email_nguoi_dung',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    'nguoi_duyet.ten as ten_nguoi_duyet',
                    'nguoi_duyet.email as email_nguoi_duyet',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->orderBy('muon_phong.ngay_muon', 'desc')
                ->get();
        }
    }

    public function _get_by_date_and_check_status($date_start, $date_end)
    {
        return $this->where('ngay_muon', '>=', $date_start)
            ->where('ngay_muon', '<=', $date_end)
            ->where('trang_thai', '1')
            ->orwhere('trang_thai', '2')
            ->select(
                'muon_phong.*',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_by_date_in_home($date_start, $date_end)
    {
        return $this->where('muon_phong.ngay_muon', '>=', $date_start)
            ->where('muon_phong.ngay_muon', '<=', $date_end)
            ->where('muon_phong.trang_thai', '1')
            ->orwhere('muon_phong.trang_thai', '2')
            ->join('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->select(
                'muon_phong.*',
                'nguoi_dung.ten as ten_nguoi_dung',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )
            ->orderBy('muon_phong.thoi_gian_bat_dau_muon', 'asc')->get();
    }

    public function _get_infor_user_borrow_room($id)
    {
        $borrow = $this->where('muon_phong.ma', $id)
            ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
            ->leftjoin('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->leftjoin('nguoi_dung as nguoi_duyet', 'nguoi_duyet.ma', '=', 'muon_phong.ma_nguoi_duyet')
            ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
            // ->join('vai_tro as vai_tro_nguoi_duyet', 'vai_tro_nguoi_duyet.ma', '=', 'nguoi_duyet.ma_vai_tro')
            ->select(
                'muon_phong.*',
                'muon_phong.ngay_muon as temp_ngay_muon',
                'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                'nguoi_dung.ten as ten_nguoi_dung',
                'nguoi_dung.email as email_nguoi_dung',
                'nguoi_dung.so_dien_thoai as so_dien_thoai_nguoi_dung',
                'vai_tro.ten as ten_vai_tro',
                'vai_tro.mo_ta as mo_ta_vai_tro',
                // 'vai_tro_nguoi_duyet.ten as ten_vai_tro_nguoi_duyet',
                // 'vai_tro_nguoi_duyet.mo_ta as mo_ta_vai_tro_nguoi_duyet',
                'nguoi_duyet.ten as ten_nguoi_duyet',
                'nguoi_duyet.tai_khoan as tai_khoan_nguoi_duyet',
                'nguoi_duyet.email as email_nguoi_duyet',
                'nguoi_duyet.so_dien_thoai as so_dien_thoai_nguoi_duyet',
                'phong.ten as ten_phong',
                'phong.mo_ta as mo_ta_phong',
                DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_duyet,"%H:%i %d-%m-%Y")) as ngay_duyet'),
                DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->first();
        if ($borrow->chuc_nang) {
            $chuc_nang = $borrow->chuc_nang;
            $list_chuc_nang = explode(",", $chuc_nang);
            $chuc_nang_su_dung = "";
            foreach ($list_chuc_nang as $key => $value) {
                $uses = Uses::where('ma', $value)->first();
                $chuc_nang_su_dung .= $uses->ten;
                $chuc_nang_su_dung .= '; ';
            }
            $chuc_nang_su_dung = substr($chuc_nang_su_dung, 0, strlen($chuc_nang_su_dung) - 2);
            $borrow['chuc_nang_su_dung'] = $chuc_nang_su_dung;
        }


        $borrow->feed_back = FeedBack::where('ma_muon_phong', $id)->where('ma_nguoi_dung', $borrow->ma_nguoi_dung)->first();
        return $borrow;
    }

    public function _signup_borrow_room_one($data, $time_open_signup)
    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!Auth::guard('nguoi_dung')->check()) {
            return response()->json([
                'status' => false,
                'message' => "Chưa đăng nhập"
            ]);
        }
        $ma_nguoi_muon = Auth::guard('nguoi_dung')->user()->ma;
        $ma_vai_tro = Auth::guard('nguoi_dung')->user()->ma_vai_tro;

        $ma_phong = $data->ma_phong;
        $ngay_muon = $data->ngay_muon;
        $thoi_gian_bat_dau_muon = $data->thoi_gian_bat_dau_muon;
        $thoi_gian_ket_thuc_muon = $data->thoi_gian_ket_thuc_muon;
        $index = $data->index;

        if ($ma_phong == null) {
            return response()->json([
                'status' => 'error_null_id_room',
                'message' => "Vui lòng chọn phòng!"
            ]);
        }

        foreach ($ngay_muon as $key => $value) {
            if ($value == null) {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn ngày mượn!"
                ]);
            }

            $kt_time_ok = 0;
            $_timenm = mktime(0, 0, 0, date_format(date_create($value), "m"), date_format(date_create($value), "d"), date_format(date_create($value), "Y"));
            $_timeht = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

            if ($_timenm < $_timeht) {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Ngày không được nhỏ hơn ngày hiện tại!"
                ]);
            }
            foreach ($time_open_signup as $key1 => $value) {
                $_timebd = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_bat_dau), "m"), date_format(date_create($value->thoi_gian_bat_dau), "d"), date_format(date_create($value->thoi_gian_bat_dau), "Y"));
                $_timekt = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_ket_thuc), "m"), date_format(date_create($value->thoi_gian_ket_thuc), "d"), date_format(date_create($value->thoi_gian_ket_thuc), "Y"));
                if (($_timebd <= $_timenm) && ($_timenm <= $_timekt)) {
                    $kt_time_ok++;
                }
            }

            if ($kt_time_ok == 0) {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Ngày mượn không đúng so với ngày mở đăng ký mượn!"
                ]);
            }
        }

        $setting_borrow_room = SettingBorrowRoom::find(1);
        $so_gio_cach_thoi_diem_hien_tai =  $setting_borrow_room->so_gio_cach_thoi_diem_hien_tai;
        $so_phut_muon_it_nhat =  $setting_borrow_room->so_phut_muon_it_nhat;

        foreach ($thoi_gian_bat_dau_muon as $key => $value) {
            if ($ngay_muon[$key] == date('Y-m-d')) {

                $time_now = mktime(date('H') +  $so_gio_cach_thoi_diem_hien_tai, date('i'), 0, 0, 0, 0);
                $time_db_1 = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$key]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$key]), "i"), 0, 0, 0, 0);
                if ($time_db_1 < $time_now) {
                    return response()->json([
                        'status' => 'error_time_today',
                        'index' => $index[$key],
                        'message' => "Ngày " . date('d/m/Y') . " phải mượn trước " .  $so_gio_cach_thoi_diem_hien_tai .  " tiếng tính từ giờ mượn"
                    ]);
                }
            }
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn thời gian mượn!"
                ]);
            }
        }

        foreach ($thoi_gian_ket_thuc_muon as $key => $value) {
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn thời gian mượn!"
                ]);
            }
        }

        for ($i = 0; $i < count($ngay_muon); $i++) {
            $time_db = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$i]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$i]), "i"), 0, 0, 0, 0);
            $time_kt = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "i") - $so_phut_muon_it_nhat, 0, 0, 0, 0);

            if ($time_db > $time_kt) {
                return response()->json([
                    'status' => 'error_time_end_big_time_start',
                    'index' => $index[$i],
                    'message' => "Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc và mượn ít nhất " . $so_phut_muon_it_nhat . " phút!"
                ]);
            }
        }




        $error_thoi_gian_xen_ke = 0;
        for ($i = 0; $i < count($ngay_muon); $i++) {
            for ($j = $i + 1; $j < count($ngay_muon); $j++) {
                if ($ngay_muon[$i] == $ngay_muon[$j]) {
                    $time_db_i = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$i]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$i]), "i"), 0, 0, 0, 0);
                    $time_kt_i = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "i"), 0, 0, 0, 0);

                    $time_db_j = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$j]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$j]), "i"), 0, 0, 0, 0);
                    $time_kt_j = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$j]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$j]), "i"), 0, 0, 0, 0);

                    if (($time_db_i < $time_db_j && $time_db_j < $time_kt_i) || ($time_db_i < $time_kt_j && $time_kt_j < $time_kt_i)) {
                        $error_thoi_gian_xen_ke++;
                    }

                    if (($time_kt_i <= $time_db_j && $time_kt_i <= $time_kt_j) || ($time_db_i >= $time_db_j && $time_db_i >= $time_kt_j)) {
                    } else {
                        $error_thoi_gian_xen_ke++;
                    }

                    if ($error_thoi_gian_xen_ke > 0) {
                        return response()->json([
                            'status' => 'error_time_xen_ke',
                            'index1' => $index[$i],
                            'index2' => $index[$j],
                            'message' => "Thời gian không đước chồng chéo, xen kẻ nhau!",
                            'message1' => "Cùng phòng, cùng ngày, thời gian bị xen kẻ nhau!",
                        ]);
                    }
                }
            }
        }

        $muon_phong = $this->_get_by_date_and_check_status($data->date_start, $data->date_end);

        $error_time_server = 0;
        foreach ($muon_phong as $key => $item) {
            for ($i = 0; $i < count($ngay_muon); $i++) {
                if ($item->ngay_muon == $ngay_muon[$i] && $item->ma_phong == $ma_phong) {
                    $time_db = mktime(date_format(date_create($item->thoi_gian_bat_dau_muon), "H"), date_format(date_create($item->thoi_gian_bat_dau_muon), "i"), 0, 0, 0, 0);
                    $time_kt = mktime(date_format(date_create($item->thoi_gian_ket_thuc_muon), "H"), date_format(date_create($item->thoi_gian_ket_thuc_muon), "i"), 0, 0, 0, 0);

                    $time_db_1 = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$i]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$i]), "i"), 0, 0, 0, 0);
                    $time_kt_1 = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "i"), 0, 0, 0, 0);

                    if (($time_db < $time_db_1 && $time_kt_1 < $time_kt) || ($time_db < $time_kt_1 && $time_kt_1 < $time_kt)) {
                        $error_time_server++;
                    }

                    if (($time_kt <= $time_db_1 && $time_kt <= $time_db_1) || ($time_db >= $time_kt_1 && $time_db >= $time_kt_1)) {
                    } else {
                        $error_time_server++;
                    }

                    if ($error_time_server > 0) {
                        $ngay_error = date_format(date_create($item->ngay_muon), "d/m/Y");
                        $error_tg_bd = date_format(date_create($item->thoi_gian_bat_dau_muon), "H:i");
                        $error_tg_kt = date_format(date_create($item->thoi_gian_ket_thuc_muon), "H:i");

                        $room = Room::where('ma', $ma_phong)->first();
                        $name_room = $room->ten;
                        return response()->json([
                            'status' => 'error_time_server',
                            'index' => $index[$i],
                            'message' => "Phòng " . $name_room . ", ngày " . $ngay_error . ", từ " . $error_tg_bd . " đến " . $error_tg_kt . " đã có người mượn!",
                        ]);
                    }
                }
            }
        }



        DB::beginTransaction();
        try {
            $time = date('Y-m-d H:i:s');
            $insert['ngay_tao'] = $time;
            $insert['ma_phong'] = $ma_phong;
            $insert['ma_nguoi_dung'] = $ma_nguoi_muon;
            $insert['ly_do_muon'] = $data->ly_do_muon;

            $role = RoleBorrowRoom::where('ma_phong', $ma_phong)->where('ma_vai_tro', $ma_vai_tro)->first();

            if ($role->dang_ky_duyet == -1) {
                return response()->json([
                    'status' => 'error_role',
                    'message' => "Bạn không có quyền mượn!"
                ]);
            } else if ($role->dang_ky_duyet == 0) {
                $insert['trang_thai'] = 2;
            } else if ($role->dang_ky_duyet == 1) {
                $insert['trang_thai'] = 1;
            } else {
                return response()->json([
                    'status' => 'error_null',
                    'message' => "Có lỗi trong quá trình thực hiện vui lòng thử lại"
                ]);
            }

            if ($data->ma_thiet_bi != []) {
                $insert['chuc_nang'] = implode(",", $data->ma_thiet_bi);
            }

            foreach ($ngay_muon as $key => $value) {
                $insert['ngay_muon'] = $value;
                $insert['thoi_gian_bat_dau_muon'] = $thoi_gian_bat_dau_muon[$key];
                $insert['thoi_gian_ket_thuc_muon'] = $thoi_gian_ket_thuc_muon[$key];
                $this->create($insert);
            }
            DB::commit();
            //Mail
            $send_mail = $this->where('muon_phong.ngay_tao', $time)
                ->where('muon_phong.ma_nguoi_dung', $ma_nguoi_muon)
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->select(
                    'muon_phong.*',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as tg_bd_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as tg_kt_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) ngaythangnam_muon')
                )->get();

            foreach ($send_mail as $key => $value) {

                if ($value->chuc_nang) {
                    $chuc_nang = $value->chuc_nang;
                    $list_chuc_nang = explode(",", $chuc_nang);
                    $chuc_nang_su_dung = "";
                    foreach ($list_chuc_nang as $key1 => $value1) {
                        $uses = Uses::where('ma', $value1)->first();
                        $chuc_nang_su_dung .= $uses->ten;
                        $chuc_nang_su_dung .= '; ';
                    }
                    $chuc_nang_su_dung = substr($chuc_nang_su_dung, 0, strlen($chuc_nang_su_dung) - 2);
                    $value['chuc_nang_su_dung'] = $chuc_nang_su_dung;
                }

                $mail = [
                    'title' => "Đăng ký mượn phòng thành công",
                    'ten_phong' => $value->ten_phong,
                    'mo_ta_phong' => $value->mo_ta_phong,
                    'ngay_muon' => $value->ngaythangnam_muon,
                    'tg_bd_muon' => $value->tg_bd_muon,
                    'tg_kt_muon' => $value->tg_kt_muon,
                    'trang_thai' => $value->trang_thai,
                    'ly_do_muon' => $value->ly_do_muon,
                    'chuc_nang_su_dung' => $value->chuc_nang_su_dung,
                ];
                $this->send_mail($mail, 'pages.email.email_borrow_room');
            }

            return response()->json([
                'status' => 'success',
                'message' => "Đăng ký mượn phòng thành công",
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error_insert',
                'message' => "Có lỗi trong quá trình thực hiện vui lòng thử lại hoặc F5!"
            ]);
        }
    }

    public function _signup_borrow_room_many($data, $time_open_signup)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!Auth::guard('nguoi_dung')->check()) {
            return response()->json([
                'status' => false,
                'message' => "Chưa đăng nhập"
            ]);
        }

        $ma_phong = $data->ma_phong;
        $ngay_muon = $data->ngay_muon;
        $thoi_gian_bat_dau_muon = $data->thoi_gian_bat_dau_muon;
        $thoi_gian_ket_thuc_muon = $data->thoi_gian_ket_thuc_muon;
        $ly_do_muon = $data->ly_do_muon;
        $ma_thiet_bi = $data->ma_thiet_bi;
        $index = $data->index;

        foreach ($ma_phong as $key => $value) {
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_id_room',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn phòng!"
                ]);
            }
        }

        foreach ($ngay_muon as $key => $value) {
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn ngày mượn!"
                ]);
            }

            $kt_time_ok = 0;
            $_timenm = mktime(0, 0, 0, date_format(date_create($value), "m"), date_format(date_create($value), "d"), date_format(date_create($value), "Y"));
            $_timeht = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

            if ($_timenm < $_timeht) {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Ngày không được nhỏ hơn ngày hiện tại!"
                ]);
            }
            foreach ($time_open_signup as $key1 => $value) {
                $_timebd = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_bat_dau), "m"), date_format(date_create($value->thoi_gian_bat_dau), "d"), date_format(date_create($value->thoi_gian_bat_dau), "Y"));
                $_timekt = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_ket_thuc), "m"), date_format(date_create($value->thoi_gian_ket_thuc), "d"), date_format(date_create($value->thoi_gian_ket_thuc), "Y"));
                if (($_timebd <= $_timenm) && ($_timenm <= $_timekt)) {
                    $kt_time_ok++;
                }
            }

            if ($kt_time_ok == 0) {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Ngày mượn không đúng so với ngày mở đăng ký mượn!"
                ]);
            }
        }

        $setting_borrow_room = SettingBorrowRoom::find(1);
        $so_gio_cach_thoi_diem_hien_tai =  $setting_borrow_room->so_gio_cach_thoi_diem_hien_tai;
        $so_phut_muon_it_nhat =  $setting_borrow_room->so_phut_muon_it_nhat;

        foreach ($thoi_gian_bat_dau_muon as $key => $value) {
            if ($ngay_muon[$key] == date('Y-m-d')) {

                $time_now = mktime(date('H') +  $so_gio_cach_thoi_diem_hien_tai, date('i'), 0, 0, 0, 0);
                $time_db_1 = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$key]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$key]), "i"), 0, 0, 0, 0);
                if ($time_db_1 < $time_now) {
                    return response()->json([
                        'status' => 'error_time_today',
                        'index' => $index[$key],
                        'message' => "Ngày " . date('d/m/Y') . " phải mượn trước " .  $so_gio_cach_thoi_diem_hien_tai .  " tiếng tính từ giờ mượn"
                    ]);
                }
            }
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn thời gian mượn!"
                ]);
            }
        }

        foreach ($thoi_gian_ket_thuc_muon as $key => $value) {
            if ($value == '') {
                return response()->json([
                    'status' => 'error_null_time',
                    'index' => $index[$key],
                    'message' => "Vui lòng chọn thời gian mượn!"
                ]);
            }
        }

        for ($i = 0; $i < count($ngay_muon); $i++) {
            $time_db = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$i]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$i]), "i"), 0, 0, 0, 0);
            $time_kt = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "i") - $so_phut_muon_it_nhat, 0, 0, 0, 0);

            if ($time_db > $time_kt) {
                return response()->json([
                    'status' => 'error_time_end_big_time_start',
                    'index' => $index[$i],
                    'message' => "Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc và mượn ít nhất " . $so_phut_muon_it_nhat . " phút!"
                ]);
            }
        }

        if (count($ma_phong) > 0) {
            $index_id_room = $this->list_array_same($ma_phong);

            $temp_date = [];
            foreach ($index_id_room as $key1 => $value1) {
                $temp = [];
                $index_t = 0;
                foreach ($ma_phong as $key2 => $value2) {
                    if ($value1 == $value2) {
                        $temp[$index_t] = $key2;
                        $index_t++;
                    }
                }
                $temp_date[$key1] = $temp;
                //Phân chia ngày mượn vào các phòng giống nhau
            }

            foreach ($temp_date as $key => $value) {
                $error_thoi_gian_xen_ke = 0;
                for ($i = 0; $i < count($value); $i++) {
                    for ($j = $i + 1; $j < count($value); $j++) {
                        if (($ngay_muon[$value[$i]] == $ngay_muon[$value[$j]]) && ($ma_phong[$value[$i]] == $ma_phong[$value[$j]])) {
                            $time_db_i = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$value[$i]]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$value[$i]]), "i"), 0, 0, 0, 0);
                            $time_kt_i = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$value[$i]]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$value[$i]]), "i"), 0, 0, 0, 0);

                            $time_db_j = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$value[$j]]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$value[$j]]), "i"), 0, 0, 0, 0);
                            $time_kt_j = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$value[$j]]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$value[$j]]), "i"), 0, 0, 0, 0);

                            if (($time_db_i < $time_db_j && $time_db_j < $time_kt_i) || ($time_db_i < $time_kt_j && $time_kt_j < $time_kt_i)) {
                                $error_thoi_gian_xen_ke++;
                            }

                            if (($time_kt_i <= $time_db_j && $time_kt_i <= $time_kt_j) || ($time_db_i >= $time_db_j && $time_db_i >= $time_kt_j)) {
                            } else {
                                $error_thoi_gian_xen_ke++;
                            }

                            if ($error_thoi_gian_xen_ke > 0) {
                                return response()->json([
                                    'status' => 'error_time_xen_ke',
                                    'index1' => $index[$value[$i]],
                                    'index2' => $index[$value[$j]],
                                    'ngay_muon' => $ngay_muon[$value[$i]],
                                    'message' => "Thời gian không đước chồng chéo, xen kẻ nhau!",
                                    'message1' => "Cùng phòng, cùng ngày, thời gian bị xen kẻ nhau!",
                                ]);
                            }
                        }
                    }
                }
            }
        }

        $muon_phong_sever = $this->_get_by_date_and_check_status($data->date_start, $data->date_end);

        foreach ($muon_phong_sever as $key => $item) {
            $error_time_sever = 0;
            for ($i = 0; $i < count($ngay_muon); $i++) {
                if ($item->ngay_muon == $ngay_muon[$i] && $item->ma_phong == $ma_phong[$i]) {
                    $time_db = mktime(date_format(date_create($item->thoi_gian_bat_dau_muon), "H"), date_format(date_create($item->thoi_gian_bat_dau_muon), "i"), 0, 0, 0, 0);
                    $time_kt = mktime(date_format(date_create($item->thoi_gian_ket_thuc_muon), "H"), date_format(date_create($item->thoi_gian_ket_thuc_muon), "i"), 0, 0, 0, 0);

                    $time_db_1 = mktime(date_format(date_create($thoi_gian_bat_dau_muon[$i]), "H"), date_format(date_create($thoi_gian_bat_dau_muon[$i]), "i"), 0, 0, 0, 0);
                    $time_kt_1 = mktime(date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "H"), date_format(date_create($thoi_gian_ket_thuc_muon[$i]), "i"), 0, 0, 0, 0);

                    if (($time_db < $time_db_1 && $time_kt_1 < $time_kt) || ($time_db < $time_kt_1 && $time_kt_1 < $time_kt)) {
                        $error_time_sever++;
                    }

                    if (($time_kt <= $time_db_1 && $time_kt <= $time_db_1) || ($time_db >= $time_kt_1 && $time_db >= $time_kt_1)) {
                    } else {
                        $error_time_sever++;
                    }

                    if ($error_time_sever > 0) {
                        $ngay_error = date_format(date_create($item->ngay_muon), "d/m/Y");
                        $error_tg_bd = date_format(date_create($item->thoi_gian_bat_dau_muon), "H:i");
                        $error_tg_kt = date_format(date_create($item->thoi_gian_ket_thuc_muon), "H:i");

                        $room = Room::where('ma', $ma_phong[$i])->first();
                        $name_room = $room->ten;
                        return response()->json([
                            'status' => 'error_time_sever',
                            'index' => $index[$i],
                            'message' => "Phòng " . $name_room . ", ngày " . $ngay_error . ", từ " . $error_tg_bd . " đến " . $error_tg_kt . " đã có người mượn!",
                        ]);
                    }
                }
            }
        }
        DB::beginTransaction();
        try {
            $ma_nguoi_muon = Auth::guard('nguoi_dung')->user()->ma;
            $ma_vai_tro = Auth::guard('nguoi_dung')->user()->ma_vai_tro;

            $trang_thai = [];
            foreach ($ma_phong as $key => $value) {
                $role = RoleBorrowRoom::where('ma_phong', $value)->where('ma_vai_tro', $ma_vai_tro)->first();

                if ($role->dang_ky_duyet == -1) {
                    return response()->json([
                        'status' => 'error_role',
                        'index' => $index[$key],
                        'message' => "Bạn không có quyền mượn!"
                    ]);
                } else if ($role->dang_ky_duyet == 0) {
                    $trang_thai[$key] = 2;
                } else if ($role->dang_ky_duyet == 1) {
                    $trang_thai[$key] = 1;
                } else {
                    $trang_thai[$key] = 1;
                }
            }

            $chuc_nang = [];
            foreach ($ma_thiet_bi as $key => $value) {
                $chuc_nang[$key] = implode(",", $value);
            }

            $ids = [];
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            $insert['ma_nguoi_dung'] = $ma_nguoi_muon;
            foreach ($ngay_muon as $key => $value) {
                $insert['ma_phong'] = $ma_phong[$key];
                $insert['ngay_muon'] = $value;
                $insert['thoi_gian_bat_dau_muon'] = $thoi_gian_bat_dau_muon[$key];
                $insert['thoi_gian_ket_thuc_muon'] = $thoi_gian_ket_thuc_muon[$key];
                $insert['chuc_nang'] = isset($chuc_nang[$key]) ? $chuc_nang[$key] : null;
                $insert['ly_do_muon'] = $ly_do_muon[$key];
                $ids[$key] = $this->insertGetId($insert);
            }
            DB::commit();

            //Mail
            $send_mail = $this->whereIn('muon_phong.ma', $ids)
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->select(
                    'muon_phong.*',
                    'phong.ten as ten_phong',
                    'phong.mo_ta as mo_ta_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as tg_bd_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as tg_kt_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) ngaythangnam_muon')
                )->get();

            foreach ($send_mail as $key => $value) {

                if ($value->chuc_nang) {
                    $chuc_nang = $value->chuc_nang;
                    $list_chuc_nang = explode(",", $chuc_nang);
                    $chuc_nang_su_dung = "";
                    foreach ($list_chuc_nang as $key1 => $value1) {
                        $uses = Uses::where('ma', $value1)->first();
                        $chuc_nang_su_dung .= $uses->ten;
                        $chuc_nang_su_dung .= '; ';
                    }
                    $chuc_nang_su_dung = substr($chuc_nang_su_dung, 0, strlen($chuc_nang_su_dung) - 2);
                    $value['chuc_nang_su_dung'] = $chuc_nang_su_dung;
                }

                $mail = [
                    'title' => "Đăng ký mượn phòng thành công",
                    'ten_phong' => $value->ten_phong,
                    'mo_ta_phong' => $value->mo_ta_phong,
                    'ngay_muon' => $value->ngaythangnam_muon,
                    'tg_bd_muon' => $value->tg_bd_muon,
                    'tg_kt_muon' => $value->tg_kt_muon,
                    'trang_thai' => $value->trang_thai,
                    'ly_do_muon' => $value->ly_do_muon,
                    'chuc_nang_su_dung' => $value->chuc_nang_su_dung,
                ];
                $this->send_mail($mail, 'pages.email.email_borrow_room');
            }

            return response()->json([
                'status' => 'success',
                'message' => "Đăng ký mượn phòng thành công!",
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error_insert',
                'message' => "Có lỗi trong quá trình thực hiện vui lòng thử lại hoặc F5!"
            ]);
        }
    }

    public function list_array_same($array)
    {
        //Trả về mảng chứa các phần tử giống nhau
        $ngay_muon = $array;
        $ngay_trung_nhau = [];
        $index_array = 0;
        if (count($ngay_muon) > 1) {
            for ($i = 0; $i < count($ngay_muon); $i++) {
                if ($ngay_muon[$i] == '') {
                    $ngay_trung_nhau = [];
                    break;
                }
                for ($j = $i + 1; $j < count($ngay_muon); $j++) {
                    if ($ngay_muon[$i] == $ngay_muon[$j]) {

                        $ngay_trung_nhau[$index_array] = $ngay_muon[$i];
                        $index_array++;
                        break;
                    }
                }
            }
        }

        $list_index_isunique = [];
        $index_array = 0;
        if (count($ngay_muon) > 1 && count($ngay_trung_nhau) > 0) {
            for ($i = 0; $i < count($ngay_trung_nhau); $i++) {
                if (!in_array($ngay_trung_nhau[$i], $list_index_isunique)) {
                    $list_index_isunique[$index_array] = $ngay_trung_nhau[$i];
                    $index_array++;
                }
            }
        }
        return $list_index_isunique;
    }

    public function list_index_array_same($array)
    {
        $ngay_muon = $array;
        $ngay_trung_nhau = [];
        $index_array = 0;
        if (count($ngay_muon) > 1) {
            for ($i = 0; $i < count($ngay_muon); $i++) {
                if ($ngay_muon[$i] == '') {
                    $ngay_trung_nhau = [];
                    break;
                }
                for ($j = $i + 1; $j < count($ngay_muon); $j++) {
                    if ($ngay_muon[$i] == $ngay_muon[$j]) {

                        $ngay_trung_nhau[$index_array] = $ngay_muon[$i];
                        $index_array++;
                        break;
                    }
                }
            }
        }



        $list_index = [];
        $index_array = 0;
        if (count($ngay_muon) > 1 && count($ngay_trung_nhau) > 0) {
            for ($i = 0; $i < count($ngay_muon); $i++) {
                for ($j = 0; $j < count($ngay_trung_nhau); $j++) {
                    if ($ngay_muon[$i] == $ngay_trung_nhau[$j]) {
                        $list_index[$index_array] = $i;
                        $index_array++;
                    }
                }
            }
        }

        $list_index_isunique = [];
        $index_array = 0;
        if (count($ngay_muon) > 1 && count($list_index) > 0) {
            for ($i = 0; $i < count($list_index); $i++) {
                if (!in_array($list_index[$i], $list_index_isunique)) {
                    $list_index_isunique[$index_array] = $list_index[$i];
                    $index_array++;
                }
            }
        }
        return $list_index_isunique;
    }
    public function send_mail($data, $email_blade_php)
    {
        $mail_setting = $this->_get_setting_mail();
        if (Auth::guard('nguoi_dung')->user()->email) {
            Mail::send($email_blade_php, $data, function ($message) use ($mail_setting) {
                $message->from($mail_setting->email, $mail_setting->ten);
                $message->to(Auth::guard('nguoi_dung')->user()->email, Auth::guard('nguoi_dung')->user()->ten);
                $message->subject('Đăng ký mượn phòng #' . rand(1000, 9999));
            });
        }
    }

    public function _get_history_signup_borrow_room()
    {
        try {
            $ma_nguoi_muon = Auth::guard('nguoi_dung')->user()->ma;
            return $this->where('muon_phong.ma_nguoi_dung', $ma_nguoi_muon)
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')

                ->select(
                    'muon_phong.*',
                    'phong.ten as ten_phong',
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_bat_dau_muon,"%H:%i")) as thoi_gian_bat_dau_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.thoi_gian_ket_thuc_muon,"%H:%i")) as thoi_gian_ket_thuc_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_muon,"%d-%m-%Y")) as ngay_muon'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->orderBy('muon_phong.ngay_muon', 'desc')
                ->get();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_by_id_and_check_auth($id)
    {
        try {
            $borrow = $this->_get_infor_user_borrow_room($id);

            if ($borrow->ma_nguoi_dung == Auth::guard('nguoi_dung')->user()->ma) {
                return $borrow;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function _delete_borrow_room($id, $ly_do_huy)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!Auth::guard('nguoi_dung')->check()) {
            return response()->json([
                'status' => false,
                'message' => "Chưa đăng nhập"
            ]);
        }

        try {
            $muon_phong = $this->where('ma', $id)->first();
            $tg_bd_muon = mktime(
                date_format(date_create($muon_phong->thoi_gian_bat_dau_muon), "H"),
                date_format(date_create($muon_phong->thoi_gian_bat_dau_muon), "i"),
                0,
                date_format(date_create($muon_phong->ngay_muon), "m"),
                date_format(date_create($muon_phong->ngay_muon), "d"),
                date_format(date_create($muon_phong->ngay_muon), "Y")
            );
            $tg_hien_tai = mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"));
            if ($tg_hien_tai >= $tg_bd_muon) {
                $gio = "" . date_format(date_create($muon_phong->thoi_gian_bat_dau_muon), "H")
                    . ':' . date_format(date_create($muon_phong->thoi_gian_bat_dau_muon), "i")
                    . ' ' . date_format(date_create($muon_phong->ngay_muon), "d")
                    . '-' . date_format(date_create($muon_phong->ngay_muon), "m")
                    . '-' . date_format(date_create($muon_phong->ngay_muon), "Y");
                return response()->json([
                    'status' => 'error_time',
                    'message' => "Bạn chỉ có thể hủy đăng ký trước: " . $gio
                ]);
            } else {
                $update = $this->find($id);
                $data['trang_thai'] = '3';
                $data['ly_do_huy'] = $ly_do_huy;
                $update->update($data);
                $infor = $this->_get_infor_user_borrow_room($id);
                $mail = [
                    'title' => "Hủy đăng ký mượn phòng thành công",
                    'ten_phong' => $infor->ten_phong,
                    'mo_ta_phong' => $infor->mo_ta_phong,
                    'ngay_muon' => $infor->ngay_muon,
                    'tg_bd_muon' => $infor->thoi_gian_bat_dau_muon,
                    'tg_kt_muon' => $infor->thoi_gian_bat_dau_muon,
                    'trang_thai' => $infor->trang_thai,
                    'ly_do_muon' => $infor->ly_do_muon,
                    'chuc_nang_su_dung' => $infor->chuc_nang_su_dung,
                    'ly_do_huy' => $infor->ly_do_huy,
                ];

                $this->send_mail($mail, 'pages.email.email_borrow_room');
                return response()->json([
                    'status' => 'success',
                    'message' => "Hủy đăng ký thành công"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra vui lòng thử lại"
            ]);
        }
    }

    public function _update_borrow_room($data, $time_open_signup)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        if (!Auth::guard('nguoi_dung')->check()) {
            return response()->json([
                'status' => 'error_auth',
                'message' => "Chưa đăng nhập"
            ]);
        }



        if (!$data['ngay_muon'] || !$data['thoi_gian_bat_dau_muon'] || !$data['thoi_gian_ket_thuc_muon']) {
            return response()->json([
                'status' => 'error_time_null',
                'message' => "Thời gian không được rỗng"
            ]);
        }

        $kt_time_ok = 0;
        $_timenm = mktime(0, 0, 0, date_format(date_create($data['ngay_muon']), "m"), date_format(date_create($data['ngay_muon']), "d"), date_format(date_create($data['ngay_muon']), "Y"));
        $_timeht = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

        if ($_timenm < $_timeht) {
            return response()->json([
                'status' => 'error_time_null',
                'message' => "Ngày không được nhỏ hơn ngày hiện tại!"
            ]);
        }
        foreach ($time_open_signup as $key => $value) {
            $_timebd = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_bat_dau), "m"), date_format(date_create($value->thoi_gian_bat_dau), "d"), date_format(date_create($value->thoi_gian_bat_dau), "Y"));
            $_timekt = mktime(0, 0, 0, date_format(date_create($value->thoi_gian_ket_thuc), "m"), date_format(date_create($value->thoi_gian_ket_thuc), "d"), date_format(date_create($value->thoi_gian_ket_thuc), "Y"));
            if (($_timebd <= $_timenm) && ($_timenm <= $_timekt)) {
                $kt_time_ok++;
            }
        }

        if ($kt_time_ok == 0) {
            return response()->json([
                'status' => 'error_time_null',
                'message' => "Ngày mượn không đúng so với ngày mở đăng ký mượn!"
            ]);
        }

        $setting_borrow_room = SettingBorrowRoom::find(1);
        $so_gio_cach_thoi_diem_hien_tai =  $setting_borrow_room->so_gio_cach_thoi_diem_hien_tai;
        $so_phut_muon_it_nhat =  $setting_borrow_room->so_phut_muon_it_nhat;

        $time = TimeOpenSemester::first();
        $muon_phong = $this->_get_by_date_and_check_status($time->thoi_gian_bat_dau, $time->thoi_gian_ket_thuc);

        $time_db_1 = mktime(date_format(date_create($data['thoi_gian_bat_dau_muon']), "H"), date_format(date_create($data['thoi_gian_bat_dau_muon']), "i"), 0, 0, 0, 0);
        $time_kt_1 = mktime(date_format(date_create($data['thoi_gian_ket_thuc_muon']), "H"), date_format(date_create($data['thoi_gian_ket_thuc_muon']), "i") - $so_phut_muon_it_nhat, 0, 0, 0, 0);

        if ($time_kt_1 < $time_db_1) {
            return response()->json([
                'status' => 'error_time_lt',
                'message' => "Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc và mượn ít nhất " . $so_phut_muon_it_nhat . " phút!"
            ]);
        }



        $time_now = mktime(date('H') +  $so_gio_cach_thoi_diem_hien_tai, date('i'), 0, 0, 0, 0);

        if ($data['ngay_muon'] == date('Y-m-d')) {

            if ($time_db_1 < $time_now) {
                return response()->json([
                    'status' => 'error_time_today',
                    'message' => "Ngày " . date('d/m/Y') . " phải mượn trước " .  $so_gio_cach_thoi_diem_hien_tai .  " tiếng tính từ giờ mượn"
                ]);
            }
        }


        foreach ($muon_phong as $key => $item) {

            if ($item->ngay_muon == $data['ngay_muon'] && $item->ma_phong == $data['ma_phong'] && $item->ma != $data['ma']) {
                $time_db = mktime(date_format(date_create($item->thoi_gian_bat_dau_muon), "H"), date_format(date_create($item->thoi_gian_bat_dau_muon), "i"), 0, 0, 0, 0);
                $time_kt = mktime(date_format(date_create($item->thoi_gian_ket_thuc_muon), "H"), date_format(date_create($item->thoi_gian_ket_thuc_muon), "i"), 0, 0, 0, 0);
                if (($time_db < $time_db_1 && $time_kt_1 < $time_kt) || ($time_db < $time_kt_1 && $time_kt_1 < $time_kt)) {
                    return response()->json([
                        'status' => 'error_time',
                        'message' => "Thời gian đã có người đăng ký",
                        'ngay_muon' => date_format(date_create($item->ngay_muon), "d/m/Y"),
                        'thoi_gian_bd' => date_format(date_create($item->thoi_gian_bat_dau_muon), "H:i"),
                        'thoi_gian_kt' => date_format(date_create($item->thoi_gian_ket_thuc_muon), "H:i"),
                    ]);
                    break;
                }

                if (($time_kt <= $time_db_1 && $time_kt <= $time_db_1) || ($time_db >= $time_kt_1 && $time_db >= $time_kt_1)) {
                } else {
                    return response()->json([
                        'status' => 'error_time',
                        'message' => "Thời gian đã có người đăng ký",
                        'ngay_muon' => date_format(date_create($item->ngay_muon), "d/m/Y"),
                        'thoi_gian_bd' => date_format(date_create($item->thoi_gian_bat_dau_muon), "H:i"),
                        'thoi_gian_kt' => date_format(date_create($item->thoi_gian_ket_thuc_muon), "H:i"),
                    ]);
                    break;
                }
            }
        }

        try {
            $infor_old = $this->_get_infor_user_borrow_room($data['ma']);
            $update = $this->find($data['ma']);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            if (isset($data['chuc_nang'])) {
                $chuc_nang = implode(",", $data['chuc_nang']);
                $data['chuc_nang'] = $chuc_nang;
            } else {
                $data['chuc_nang'] = null;
            }

            $role = RoleBorrowRoom::where('ma_phong', $data['ma_phong'])->where('ma_vai_tro', Auth::guard('nguoi_dung')->user()->ma_vai_tro)->first();

            if ($role->dang_ky_duyet == -1) {
                return response()->json([
                    'status' => 'error_role',
                    'message' => "Bạn không có quyền mượn!"
                ]);
            } else if ($role->dang_ky_duyet == 0) {
                $data['trang_thai'] = 2;
            } else if ($role->dang_ky_duyet == 1) {
                $data['trang_thai'] = 1;
                $data['ma_nguoi_duyet'] = NULL;
            } else {
                return response()->json([
                    'status' => 'error_null',
                    'message' => "Có lỗi trong quá trình thực hiện vui lòng thử lại"
                ]);
            }

            $update->update($data);
            $infor = $this->_get_infor_user_borrow_room($data['ma']);
            $mail = [
                'title' => "Cập nhật đăng ký mượn phòng thành công",

                'ten_phong_cu' => $infor_old->ten_phong,
                'mo_ta_phong_cu' => $infor_old->mo_ta_phong,
                'ngay_muon_cu' => $infor_old->ngay_muon,
                'tg_bd_muon_cu' => $infor_old->thoi_gian_bat_dau_muon,
                'tg_kt_muon_cu' => $infor_old->thoi_gian_ket_thuc_muon,
                'trang_thai_cu' => $infor_old->trang_thai,
                'ly_do_muon_cu' => $infor_old->ly_do_muon,
                'chuc_nang_su_dung_cu' => $infor_old->chuc_nang_su_dung,

                'ten_phong' => $infor->ten_phong,
                'mo_ta_phong' => $infor->mo_ta_phong,
                'ngay_muon' => $infor->ngay_muon,
                'tg_bd_muon' => $infor->thoi_gian_bat_dau_muon,
                'tg_kt_muon' => $infor->thoi_gian_ket_thuc_muon,
                'trang_thai' => $infor->trang_thai,
                'ly_do_muon' => $infor->ly_do_muon,
                'chuc_nang_su_dung' => $infor->chuc_nang_su_dung,
            ];

            $this->send_mail($mail, 'pages.email.update_email_borrow_room');

            return response()->json([
                'status' => 'success',
                'message' => "Cập nhật thành công"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Có lỗi trong quá trình thực hiện. Vui lòng thử lại"
            ]);
        }
    }

    public function _get_chart($data)
    {
        if ($data->room_ids != []) {
            $list_room = Room::whereIn('ma', $data->room_ids)->get();
        } else {
            $list_room = Room::get();
        }


        $chart_list_room = [];
        $chart_value = [];
        $backgroundColor = [];
        $borderColor = [];

        $borrow_room = $this->_get_borrow_room_all($data->date_start, $data->date_end, $data->ma_nguoi_dung, $data->ma_nguoi_duyet, $data->room_ids, $data->uses_ids, '2');

        foreach ($list_room as $key => $value) {
            $chart_list_room[$key] = $value->ten;
            $chart_value[$key] = 0;
            if ($key % 2 == 0) {
                $backgroundColor[$key] = "rgba(255, 205, 86, 0.2)";
                $borderColor[$key] = "rgb(255, 205, 86)";
            } else {
                $backgroundColor[$key] = "rgba(54, 162, 235, 0.2)";
                $borderColor[$key] = "rgb(54, 162, 235)";
            }
        }

        foreach ($list_room as $key => $value) {
            foreach ($borrow_room as $key1 => $value1) {
                if ($value->ma == $value1->ma_phong) {
                    $hours = $this->differenceInHours($value1->thoi_gian_bat_dau_muon, $value1->thoi_gian_ket_thuc_muon);
                    $chart_value[$key] += $hours;
                }
            }
        }


        $data = response()->json([
            'chart_list_room' => $chart_list_room,
            'chart_value' => $chart_value,
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
            'borrow_room' => $borrow_room
        ]);
        $excel = [];
        $excel['chart_list_room'] = $chart_list_room;
        $excel['chart_value'] = $chart_value;

        Session::put('excel_borrow_room_frequency_of_room_use', $excel);
        return $data;
    }


    public function differenceInHours($startdate, $enddate)
    {
        $starttimestamp = strtotime($startdate);
        $endtimestamp = strtotime($enddate);
        $difference = abs($endtimestamp - $starttimestamp) / 3600;
        return $difference;
    }

    public function _get_setting_mail()
    {
        return SettingMail::find(1);
    }
}
