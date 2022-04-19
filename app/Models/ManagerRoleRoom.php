<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Auth;
use Database\Seeders\nguoi_dung;

class ManagerRoleRoom extends Model
{
    use HasFactory;

    protected $table = 'quan_ly_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_nguoi_dung',
        'ma_nguoi_cap',
        'ma_phong',
        'co_quyen',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'quan_ly_phong.*',
                DB::raw('(DATE_FORMAT(quan_ly_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(quan_ly_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _insert($request)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {

            $id_user = $request['ma_nguoi_dung'];
            $data = [];

            foreach ($id_user as $key => $value) {
                $role = $this->where('ma_phong', $request['ma_phong'])
                    ->where('ma_nguoi_dung', $value)->first();
                if ($role) {
                    $data['co_quyen'] = '1';
                    $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                    $role->update($data);
                } else {
                    $data['ngay_tao'] = date('Y-m-d H:i:s');
                    $data['ma_phong'] = $request['ma_phong'];
                    $data['co_quyen'] = '1';
                    $data['ma_nguoi_cap'] = Auth::guard('nguoi_dung')->user()->ma;
                    $data['ma_nguoi_dung'] = $value;
                    $this->create($data);
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
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

    public function _deletes($request)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {

            $id_user = $request['ma_nguoi_dung_xoa'];
            $data = [];

            foreach ($id_user as $key => $value) {
                $role = $this->where('ma_phong', $request['ma_phong'])
                    ->where('ma_nguoi_dung', $value)->first();
                if ($role) {
                    $data['co_quyen'] = '0';
                    $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                    $role->update($data);
                }
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function _delete_but_update($id)
    {
        try {
            $update = $this->find($id);
            $data['co_quyen'] = '0';
            return $update->update($data);
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

    public function _get_by_id($id)
    {
        try {
            return $this->find($id);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_by_id_user($id)
    {
        try {
            return $this->where('ma_nguoi_dung', $id)->get();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_by_id_room($id)
    {
        try {
            return
                $this->where('quan_ly_phong.ma_phong', $id)
                ->where('quan_ly_phong.co_quyen', '1')
                ->join('nguoi_dung as nguoi_dung', 'nguoi_dung.ma', '=', 'quan_ly_phong.ma_nguoi_dung')
                ->join('nguoi_dung as nguoi_cap', 'nguoi_cap.ma', '=', 'quan_ly_phong.ma_nguoi_cap')
                ->select(
                    'quan_ly_phong.*',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                    'nguoi_cap.ten as ten_nguoi_cap',
                    'nguoi_cap.tai_khoan as tai_khoan_nguoi_cap',
                    DB::raw('(DATE_FORMAT(quan_ly_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(quan_ly_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->orderBy('quan_ly_phong.ma', 'desc')
                ->get();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_by_id_room_and_check_roles($id)
    {

        $manager_role = ManagerRoleRoom::where('ma_nguoi_dung', Auth::guard('nguoi_dung')->user()->ma)->get();
        $role = [];
        foreach ($manager_role as $key => $value) {
            if ($value->co_quyen == '1') {
                $role[$key] = $value->ma_phong;
            }
        }
        if (!in_array($id, $role)) {
            return 'error_id_room';
        }

        return $this->_get_by_id_room($id);
    }

    public function _get_infor_user_manager_room($id)
    {

        return $this->where('quan_ly_phong.ma_phong', $id)
            ->where('quan_ly_phong.co_quyen', '1')
            ->join('nguoi_dung', 'quan_ly_phong.ma_nguoi_dung', '=', 'nguoi_dung.ma')
            ->select(
                'nguoi_dung.ten as ten_nguoi_dung',
                'nguoi_dung.tai_khoan as tai_khoan_nguoi_dung',
                'nguoi_dung.email as email_nguoi_dung',
                'nguoi_dung.so_dien_thoai as so_dien_thoai_nguoi_dung',
            )
            ->get();
    }
}
