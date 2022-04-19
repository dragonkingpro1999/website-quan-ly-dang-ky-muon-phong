<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use App\Models\ManagerRoleRoom;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class Decentralization extends Model
{
    use HasFactory;

    protected $table = 'phan_quyen';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_quyen',
        'ma_nguoi_dung',
        'ma_nguoi_cap',
        'co_quyen',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'phan_quyen.*',
                DB::raw('(DATE_FORMAT(phan_quyen.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phan_quyen.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_by_id_user($id)
    {
        try {
            return $this->where('phan_quyen.ma_nguoi_dung', $id)->orderBy('ma', 'asc')
                ->join('quyen', 'quyen.ma', '=', 'phan_quyen.ma_quyen')
                ->select(
                    'phan_quyen.*',
                    'quyen.ten as ten_quyen',
                    'quyen.mo_ta as mo_ta_quyen',
                    'quyen.url as url',
                    DB::raw('(DATE_FORMAT(phan_quyen.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(phan_quyen.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->get();
        } catch (Exception $e) {
            return false;
        }
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

    public function _update($phan_quyen, $phan_quyen_phong, $id)
    {
        // dd($phan_quyen_phong);
        DB::beginTransaction();
        $quyen = DB::table('quyen')->get();
        foreach ($quyen as $key => $item) {
            if (!isset($phan_quyen[$item->ma])) {
                $phan_quyen[$item->ma] = "0";
            }
        }
        $room = Room::get();
        foreach ($room as $key => $item) {
            if (!isset($phan_quyen_phong[$item->ma])) {
                $phan_quyen_phong[$item->ma] = "0";
            }
        }

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            // Phân quyền menu
            foreach ($phan_quyen as $key => $item) {
                $role = $this->where('ma_nguoi_dung', $id)->where('ma_quyen', $key)->first();


                if ($role) {
                    $data_role_1['co_quyen'] = $item;
                    $data_role_1['ma_nguoi_cap'] = Auth::guard('nguoi_dung')->user()->ma;
                    $data_role_1['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                    $role->update($data_role_1);
                } else {
                    $data_role_2['co_quyen'] = $item;
                    $data_role_2['ma_nguoi_cap'] = Auth::guard('nguoi_dung')->user()->ma;
                    $data_role_2['ngay_tao'] = date('Y-m-d H:i:s');
                    $data_role_2['ma_nguoi_dung'] = $id;
                    $data_role_2['ma_quyen'] = $key;
                    $this->create($data_role_2);
                }
            }

            // Phân quyền phòng
            $i = 0;
            foreach ($phan_quyen_phong as $key => $item) {

                $role1 = ManagerRoleRoom::where('ma_nguoi_dung', $id)->where('ma_phong', $key)->first();

                if ($role1 == null) {
                    $data1['co_quyen'] = $item;
                    $data1['ma_nguoi_cap'] = Auth::guard('nguoi_dung')->user()->ma;
                    $data1['ngay_tao'] = date('Y-m-d H:i:s');
                    $data1['ma_nguoi_dung'] = $id;
                    $data1['ma_phong'] = $key;
                    ManagerRoleRoom::create($data1);
                } else {
                    $data2['co_quyen'] = $item;
                    $data2['ma_nguoi_cap'] = Auth::guard('nguoi_dung')->user()->ma;
                    $data2['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                    $role1->update($data2);
                }
            }
            DB::commit();
            return true;
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
}
