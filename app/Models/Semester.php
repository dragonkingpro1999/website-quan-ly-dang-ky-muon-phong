<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'hoc_ky';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ten',
        'mo_ta',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'hoc_ky.*',
                DB::raw('(DATE_FORMAT(hoc_ky.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(hoc_ky.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
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

    public function _get_by_id($id)
    {
        try {
            return $this->find($id);
        } catch (Exception $e) {
            return false;
        }
    }

    public function _name_is_unique($name, $id)
    {
        try {
            if ($id == "") {
                $name = $this->where('ten', $name)->count();
            } else {
                $name = $this->whereNotIn('ma', [$id])->where('ten', $name)->count();
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
}
