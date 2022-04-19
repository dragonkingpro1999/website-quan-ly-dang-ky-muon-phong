<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class RoleBorrowRoom extends Model
{
    use HasFactory;

    protected $table = 'vai_tro_muon_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_phong',
        'ma_vai_tro',
        'dang_ky_duyet',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'vai_tro_muon_phong.*',
                DB::raw('(DATE_FORMAT(vai_tro_muon_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(vai_tro_muon_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
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
            return
                $this->where('ma_phong', $id)->orderBy('ma_vai_tro', 'asc')->get();
        } catch (Exception $e) {
            return false;
        }
    }
}
