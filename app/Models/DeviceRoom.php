<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManagerRoleRoom;
use Exception;
use DB;
use Auth;

class DeviceRoom extends Model
{
    use HasFactory;

    protected $table = 'thiet_bi_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_phong',
        'ma_thiet_bi',
        'so_luong',
        'so_luong_hu',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'thiet_bi_phong.*',
                DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _insert($device, $room_id)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $insert['ma_phong'] = $room_id;
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            foreach ($device as $key => $item) {
                $insert['ma_thiet_bi'] = $key;
                $insert['so_luong'] = (($item) ? $item : 0);
                $insert['so_luong_hu'] = 0;
                $this->create($insert);
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

    public function _deletes($data)
    {
        DB::beginTransaction();
        try {
            $list_uses = $data['ma_thiet_bi_xoa'];

            $room_id = $data['ma_phong'];
            foreach ($list_uses as $key => $item) {
                $delete = $this->where('ma_phong', $room_id)->where('ma_thiet_bi', $item)->first();
                $delete->delete();
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function _get_by_id($id)
    {
        return
            $this->where('thiet_bi_phong.ma', $id)
            ->join('thiet_bi', 'thiet_bi.ma', '=', 'thiet_bi_phong.ma_thiet_bi')
            ->join('phong', 'phong.ma', '=', 'thiet_bi_phong.ma_phong')
            ->select(
                'thiet_bi_phong.*',
                'thiet_bi.ten as ten_thiet_bi',
                'thiet_bi.mo_ta as mo_ta_thiet_bi',
                'phong.ten as ten_phong',
                'phong.mo_ta as mo_ta_phong',
                DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )
            ->orderBy('thiet_bi_phong.ma', 'desc')
            ->first();
        try {
        } catch (Exception $e) {
            return false;
        }
    }
    public function _get_by_id_room($id)
    {
        try {
            return
                $this->where('ma_phong', $id)
                ->join('thiet_bi', 'thiet_bi.ma', '=', 'thiet_bi_phong.ma_thiet_bi')
                ->select(
                    'thiet_bi_phong.*',
                    'thiet_bi.ten as ten_thiet_bi',
                    'thiet_bi.mo_ta as mo_ta_thiet_bi',
                    DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(thiet_bi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->orderBy('thiet_bi_phong.ma', 'desc')
                ->get();
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
}
