<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Illuminate\Support\Facades\Session;

class TimeOpenSemester extends Model
{
    use HasFactory;

    protected $table = 'tg_mo_hoc_ky';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_nam_hoc',
        'ma_hoc_ky',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'trang_thai',
        'mac_dinh',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this
            ->orderBy('tg_mo_hoc_ky.thoi_gian_bat_dau', 'desc')
            ->join('nam_hoc', 'nam_hoc.ma', '=', 'tg_mo_hoc_ky.ma_nam_hoc')
            ->join('hoc_ky', 'hoc_ky.ma', '=', 'tg_mo_hoc_ky.ma_hoc_ky')
            ->select(
                'tg_mo_hoc_ky.*',
                'nam_hoc.nam_dau',
                'nam_hoc.nam_sau',
                'hoc_ky.ten as ten_hoc_ky',
                'hoc_ky.mo_ta as mo_ta_hoc_ky',
                DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_bat_dau,"%d-%m-%Y")) as thoi_gian_bat_dau'),
                DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_ket_thuc,"%d-%m-%Y")) as thoi_gian_ket_thuc'),
                DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )
            ->get();
    }

    public function _insert($insert)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            $insert['mac_dinh'] = false;
            $insert['trang_thai'] = false;
            return $this->create($insert);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _delete($id)
    {
        try {
            $delete = $this->find($id);
            if ($delete->mac_dinh == false) {
                $delete->delete();
                Session::put('success', "Xóa thời gian mở học kỳ thành công");
                return redirect()->route('time_open_semester');
            } else {
                Session::put('error', "Không thể xóa khi đang làm mặc định!");
                return redirect()->route('time_open_semester');
            }
        } catch (Exception $e) {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('time_open_semester');
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
            try {
                return $this
                    ->where('tg_mo_hoc_ky.ma', $id)
                    ->join('nam_hoc', 'nam_hoc.ma', '=', 'tg_mo_hoc_ky.ma_nam_hoc')
                    ->join('hoc_ky', 'hoc_ky.ma', '=', 'tg_mo_hoc_ky.ma_hoc_ky')
                    ->select(
                        'tg_mo_hoc_ky.*',
                        'nam_hoc.nam_dau',
                        'nam_hoc.nam_sau',
                        'hoc_ky.ten as ten_hoc_ky',
                        'hoc_ky.mo_ta as mo_ta_hoc_ky',
                        DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_bat_dau,"%d-%m-%Y")) as thoi_gian_bat_dau'),
                        DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_ket_thuc,"%d-%m-%Y")) as thoi_gian_ket_thuc'),
                        DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                        DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                    )
                    ->first();
            } catch (Exception $e) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function check_school_year__and_semester_is_unique($ma_nam_hoc, $ma_hoc_ky, $id)
    {
        try {
            if ($id == "") {
                $check = $this->where('ma_nam_hoc', $ma_nam_hoc)->where('ma_hoc_ky', $ma_hoc_ky)->count();
            } else {
                $check = $this->whereNotIn('ma', [$id])->where('ma_nam_hoc', $ma_nam_hoc)->where('ma_hoc_ky', $ma_hoc_ky)->count();
            }
            // return $name;
            if ($check == 0) {
                return -1;
            } else {
                return 1;
            }
        } catch (Exception $e) {
            return -1;
        }
    }

    public function _status($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            if ($update->trang_thai) {
                $data['trang_thai'] = false;
            } else {
                $data['trang_thai'] = true;
            }
            return $update->update($data);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _default($id)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {

            $update1 = $this->where('mac_dinh', true)->first();
            $data1['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $data1['mac_dinh'] = false;
            $update1->update($data1);

            $update2 = $this->find($id);
            $data2['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $data2['mac_dinh'] = true;
            $update2->update($data2);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function _get_date_default()
    {
        try {
            return $this
                ->where('tg_mo_hoc_ky.mac_dinh', true)
                ->join('nam_hoc', 'nam_hoc.ma', '=', 'tg_mo_hoc_ky.ma_nam_hoc')
                ->join('hoc_ky', 'hoc_ky.ma', '=', 'tg_mo_hoc_ky.ma_hoc_ky')
                ->select(
                    'tg_mo_hoc_ky.*',
                    'nam_hoc.nam_dau',
                    'nam_hoc.nam_sau',
                    'hoc_ky.ten as ten_hoc_ky',
                    'hoc_ky.mo_ta as mo_ta_hoc_ky',
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_bat_dau,"%d-%m-%Y")) as thoi_gian_bat_dau'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_ket_thuc,"%d-%m-%Y")) as thoi_gian_ket_thuc'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->first();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _get_time_open_semester_can_min()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            return $this
                ->where('trang_thai', true)
                ->orderBy('thoi_gian_bat_dau', 'asc')
                ->first()
                ->thoi_gian_bat_dau;
        } catch (Exception $e) {
            return date('Y-m-d H:i:s');
        }
    }

    public function _get_time_open_semester_can_max()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            return $this
                ->where('trang_thai', true)
                ->orderBy('thoi_gian_ket_thuc', 'desc')
                ->first()
                ->thoi_gian_ket_thuc;
        } catch (Exception $e) {
            return date('Y-m-d H:i:s');
        }
    }

    public function _get_time_open_signup()
    {
        try {
            return $this
                ->where('tg_mo_hoc_ky.trang_thai', true)
                ->select(
                    'tg_mo_hoc_ky.*',
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_bat_dau,"%d-%m-%Y")) as thoi_gian_bat_dau'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.thoi_gian_ket_thuc,"%d-%m-%Y")) as thoi_gian_ket_thuc'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(tg_mo_hoc_ky.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->get();
        } catch (Exception $e) {
            return false;
        }
    }
}
