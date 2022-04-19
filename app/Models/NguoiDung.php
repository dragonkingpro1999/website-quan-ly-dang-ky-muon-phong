<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use DB;
use App\Models\Unit;

class NguoiDung extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'nguoi_dung';

    public $timestamps = false;

    protected $primaryKey = 'ma';

    protected $fillable = [
        'ma_vai_tro',
        'tai_khoan',
        'password',
        'ten',
        'email',
        'so_dien_thoai',
        'khoa_tai_khoan',
        'ma_don_vi',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    public function _get_by_id($id)
    {
        try {
            $data = $this->where('nguoi_dung.ma', $id)
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'nguoi_dung.*',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    DB::raw('(DATE_FORMAT(nguoi_dung.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(nguoi_dung.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->first();
            if ($data->ma_don_vi) {
                $unit = Unit::find($data->ma_don_vi);
                $data->ten_don_vi = $unit->ten;
            } else {
                $data->ten_don_vi = "Chưa có đơn vị";
            }
            return $data;
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

    public function _update_password($data, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            if ($data['up_password'] != '') {
                $data['password'] = bcrypt($data['up_password']);
            }
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            return $update->update($data);
        } catch (Exception $e) {
            return false;
        }
    }


    public function _get_all()
    {
        try {
            return $this
                ->join('vai_tro', 'vai_tro.ma', '=', 'nguoi_dung.ma_vai_tro')
                ->select(
                    'nguoi_dung.*',
                    'vai_tro.ten as ten_vai_tro',
                    'vai_tro.mo_ta as mo_ta_vai_tro',
                    DB::raw('(DATE_FORMAT(nguoi_dung.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(nguoi_dung.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->orderBy('nguoi_dung.ma', 'desc')
                ->get();
        } catch (Exception $e) {
            return false;
        }
    }
    public function _get_all_join_null()
    {
        try {
            $data = $this->_get_all();
            foreach ($data as $key => $value) {
                if ($value->ma_don_vi) {
                    $unit = Unit::find($value->ma_don_vi);
                    $value->ten_don_vi = $unit->ten;
                } else {
                    $value->ten_don_vi = "Chưa có đơn vị";
                }
            }
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }

    public function _insert($insert)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $insert['password'] = bcrypt($insert['password']);
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

    public function _username_is_unique($name, $id)
    {
        try {
            if ($id == "") {
                $name = $this->where('tai_khoan', $name)->count();
            } else {
                $name = $this->whereNotIn('tai_khoan', [$id])->where('ten', $name)->count();
            }
            // return $name;
            if ($name == 0) {
                return -1;
            } else {
                return 1;
            }
        } catch (Exception $e) {
            return -1;
        }
    }

    public function _email_is_unique($email, $id)
    {
        try {
            if ($id == "") {
                $email = $this->where('email', $email)->count();
            } else {
                $email = $this->whereNotIn('ma', [$id])->where('email', $email)->count();
            }
            if ($email == 0) {
                return -1;
            } else {
                return 1;
            }
        } catch (Exception $e) {
            return -1;
        }
    }

    public function _phone_is_unique($phone, $id)
    {

        try {
            if ($id == "") {
                $phone = $this->where('so_dien_thoai', $phone)->count();
            } else {
                $phone = $this->whereNotIn('ma', [$id])->where('so_dien_thoai', $phone)->count();
            }
            if ($phone == 0) {
                return -1;
            } else {
                return 1;
            }
        } catch (Exception $e) {
            return -1;
        }
    }
}
