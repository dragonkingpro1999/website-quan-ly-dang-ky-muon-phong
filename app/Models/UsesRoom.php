<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ManagerRoleRoom;
use Exception;
use DB;
use Auth;

class UsesRoom extends Model
{
    use HasFactory;

    protected $table = 'chuc_nang_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_phong',
        'ma_chuc_nang',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'chuc_nang_phong.*',
                DB::raw('(DATE_FORMAT(chuc_nang_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(chuc_nang_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _insert($data)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $list_uses = $data['ma_chuc_nang'];

            $insert['ma_phong'] = $data['ma_phong'];
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            foreach ($list_uses as $key => $item) {
                $insert['ma_chuc_nang'] = $item;
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
            $list_uses = $data['ma_chuc_nang_xoa'];

            $room_id = $data['ma_phong'];
            foreach ($list_uses as $key => $item) {
                $delete = $this->where('ma_phong', $room_id)->where('ma_chuc_nang', $item)->first();
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
        try {
            return $this->find($id);
        } catch (Exception $e) {
            return false;
        }
    }
    public function _get_by_id_room($id)
    {
        try {
            return $this->where('ma_phong', $id)
                ->join('chuc_nang', 'chuc_nang.ma', '=', 'chuc_nang_phong.ma_chuc_nang')
                ->select(
                    'chuc_nang_phong.*',
                    'chuc_nang.ten as ten_chuc_nang',
                    'chuc_nang.mo_ta as mo_ta_chuc_nang',
                    DB::raw('(DATE_FORMAT(chuc_nang_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(chuc_nang_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->orderBy('chuc_nang_phong.ma', 'desc')
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
}
