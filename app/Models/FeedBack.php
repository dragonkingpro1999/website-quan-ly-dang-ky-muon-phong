<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Illuminate\Support\Facades\Auth;

class FeedBack extends Model
{
    use HasFactory;

    protected $table = 'phan_hoi_phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_nguoi_dung',
        'ma_nguoi_tra_loi',
        'ma_muon_phong',
        'noi_dung',
        'da_xu_ly',
        'noi_dung_tra_loi',
        'ngay_xu_ly',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->join('muon_phong', 'muon_phong.ma', '=', 'phan_hoi_phong.ma_muon_phong')
            ->join('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
            ->select(
                'phan_hoi_phong.*',
                'nguoi_dung.ten as ten_nguoi_dung',
                'phong.ten as ten_phong',
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_xu_ly,"%H:%i %d-%m-%Y")) as ngay_xu_ly'),
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_feed_back($id_room)
    {
        $data = $this->orderBy('phan_hoi_phong.ma', 'desc')
            ->join('muon_phong', 'muon_phong.ma', '=', 'phan_hoi_phong.ma_muon_phong')
            ->join('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
            ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
            ->where('muon_phong.ma_phong', $id_room)
            ->select(
                'phan_hoi_phong.*',
                'nguoi_dung.ten as ten_nguoi_dung',
                'phong.ten as ten_phong',
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_xu_ly,"%H:%i %d-%m-%Y")) as ngay_xu_ly'),
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
        return $data;
    }

    public function add_feed_back_room($request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            $insert['ma_nguoi_dung'] = Auth::guard('nguoi_dung')->user()->ma;
            $insert['ma_muon_phong'] = $request->id;
            $insert['noi_dung'] = $request->noi_dung;
            $insert['da_xu_ly'] = 1;
            $this->create($insert);
            return response()->json([
                'status' => 'success',
                'message' => 'Phản hồi thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Phản hồi thất bại!'
            ]);
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

    public function delete_feed_back_room($request)
    {
        try {
            $delete = $this->where('ma_muon_phong', $request->id)->first();
            $delete->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Xóa thất bại vui lòng thử lại! Hoặc liên hệ nhà phát triển!'
            ]);
        }
    }

    public function _update($data, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $data['ngay_xu_ly'] = date('Y-m-d H:i:s');
            $data['ma_nguoi_tra_loi'] = Auth::guard('nguoi_dung')->user()->ma;
            return $update->update($data);
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit_feed_back_room($request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->where('ma_muon_phong', $request->id)->first();
            $data['noi_dung'] = $request->noi_dung;
            $data['da_xu_ly'] = 1;
            $data['noi_dung_tra_loi'] = null;
            $data['ma_nguoi_tra_loi'] = null;
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $update->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => 'Cập nhật thất bại vui lòng thử lại! Hoặc liên hệ nhà phát triển!'
            ]);
        }
    }


    public function _get_by_id($id)
    {
        try {
            return $this->where('phan_hoi_phong.ma', $id)
                ->join('muon_phong', 'muon_phong.ma', '=', 'phan_hoi_phong.ma_muon_phong')
                ->join('nguoi_dung', 'nguoi_dung.ma', '=', 'muon_phong.ma_nguoi_dung')
                ->join('phong', 'phong.ma', '=', 'muon_phong.ma_phong')
                ->select(
                    'phan_hoi_phong.*',
                    'nguoi_dung.ten as ten_nguoi_dung',
                    'phong.ten as ten_phong',
                    DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_xu_ly,"%H:%i %d-%m-%Y")) as ngay_xu_ly'),
                    DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(phan_hoi_phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->first();
        } catch (Exception $e) {
            return false;
        }
    }
}
