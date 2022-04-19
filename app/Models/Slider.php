<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Carbon\Carbon;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'thanh_truot';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'hinh_anh',
        'tieu_de',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'thanh_truot.*',
                DB::raw('(DATE_FORMAT(thanh_truot.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(thanh_truot.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _insert($insert, $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $get_image = $request->file('hinh_anh');

            if ($get_image) {
                $d = Carbon::now('Asia/Ho_Chi_Minh')->day; //ngày
                $m = Carbon::now('Asia/Ho_Chi_Minh')->month; //tháng
                $y = Carbon::now('Asia/Ho_Chi_Minh')->year; //năm
                $h = Carbon::now('Asia/Ho_Chi_Minh')->hour; //giờ
                $mi = Carbon::now('Asia/Ho_Chi_Minh')->minute; //phút
                $s = Carbon::now('Asia/Ho_Chi_Minh')->second; //giây
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $rand = rand(0, 999);
                $new_image = $name_image . '_' . $d . '_' . $m . '_' . $y . '_' . $h . '_' . $mi . '_' . $s . '_' . $rand . '.' . $get_image->getClientOriginalExtension();
                // dd($get_image->move('admin/img/img_room', $new_image));
                $get_image->move('home/img_slider', $new_image);

                $insert['hinh_anh'] = $new_image;
            } else {
                return false;
            }
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
            if ($delete->hinh_anh == "") {
            } else {
                $img = 'home/img_slider/' . $delete->hinh_anh;
                if (file_exists($img)) {
                    unlink($img);
                }
            }
            return $delete->delete();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _update($data, $id, $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);

            $get_image = $request->file('hinh_anh');

            if ($get_image) {
                $d = Carbon::now('Asia/Ho_Chi_Minh')->day; //ngày
                $m = Carbon::now('Asia/Ho_Chi_Minh')->month; //tháng
                $y = Carbon::now('Asia/Ho_Chi_Minh')->year; //năm
                $h = Carbon::now('Asia/Ho_Chi_Minh')->hour; //giờ
                $mi = Carbon::now('Asia/Ho_Chi_Minh')->minute; //phút
                $s = Carbon::now('Asia/Ho_Chi_Minh')->second; //giây
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $rand = rand(0, 999);
                $new_image = $name_image . '_' . $d . '_' . $m . '_' . $y . '_' . $h . '_' . $mi . '_' . $s . '_' . $rand . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('home/img_slider/', $new_image);

                $data['hinh_anh'] = $new_image;

                $pro = $this::find($id);
                if (!$pro->hinh_anh == "") {
                    $img = 'home/img_slider/' . $pro->hinh_anh;

                    if (file_exists($img)) {
                        unlink($img);
                    }
                }
            }

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
}
