<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use App\Models\Uses;
use App\Models\UsesRoom;
use App\Models\Device;
use App\Models\DeviceRoom;
use App\Models\RoleBorrowRoom;
use App\Models\ManagerRoleRoom;

use Auth;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $table = 'phong';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ma_loai_phong',
        'ten',
        'suc_chua',
        'trang_thai',
        'hien_thi',
        'vi_tri',
        'mo_ta',
        'hinh_anh',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this->orderBy('phong.ma', 'desc')
            ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
            ->select(
                'phong.*',
                'loai_phong.ten as ten_loai_phong',
                'loai_phong.mo_ta as mo_ta_loai_phong',
                DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_all_by_role_room()
    {
        $manager_role = ManagerRoleRoom::where('ma_nguoi_dung', Auth::guard('nguoi_dung')->user()->ma)->get();
        $role = [];
        foreach ($manager_role as $key => $value) {
            if ($value->co_quyen == '1') {
                $role[$key] = $value->ma_phong;
            }
        }

        return $this->whereIn('phong.ma', $role)
            ->orderBy('phong.ma', 'desc')
            ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
            ->select(
                'phong.*',
                'loai_phong.ten as ten_loai_phong',
                'loai_phong.mo_ta as mo_ta_loai_phong',
                DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }

    public function _get_all_orderby_ma()
    {
        return $this->orderBy('phong.ma', 'asc')
            ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
            ->select(
                'phong.*',
                'loai_phong.ten as ten_loai_phong',
                'loai_phong.mo_ta as mo_ta_loai_phong',
                DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();
    }


    public function _get_room_by_role_borrow($id)
    {
        if (!$id) return false;
        $room = $this->where('hien_thi', true)->orderBy('phong.ma', 'desc')
            ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
            ->select(
                'phong.*',
                'loai_phong.ten as ten_loai_phong',
                'loai_phong.mo_ta as mo_ta_loai_phong',
                DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )->get();

        $role_borrow_room = RoleBorrowRoom::where('ma_vai_tro', $id)->get();
        $result = [];
        $result['room'] = $room;
        $result['role_borrow_room']  = $role_borrow_room;
        return $result;
    }

    public function _insert($insert_room, $insert_role_room, $request)
    {
        // dd($insert_role_room);
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $insert_room['ngay_tao'] = date('Y-m-d H:i:s');
            //Ảnh
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

                $get_image->move('admin/img/img_room', $new_image);
                $insert_room['hinh_anh'] = $new_image;
            } else {
                $insert_room['hinh_anh'] = "";
            }

            $id = $this->insertGetId($insert_room);

            $data_insert_role_room['ma_phong'] = $id;
            foreach ($insert_role_room as $key => $item) {
                $data_insert_role_room['ma_vai_tro'] = $key;
                $data_insert_role_room['dang_ky_duyet'] = $item;
                $data_insert_role_room['ngay_tao'] = date('Y-m-d H:i:s');
                RoleBorrowRoom::create($data_insert_role_room);
            }

            $root = [];
            $root['ma_nguoi_dung'] = 1;
            $root['ma_phong'] = $id;
            $root['co_quyen'] = 1;
            $root['ngay_tao'] = date('Y-m-d H:i:s');;
            ManagerRoleRoom::create($root);
            if (Auth::guard('nguoi_dung')->user()->ma != 1) {
                $auth = [];
                $auth['ma_nguoi_dung'] = Auth::guard('nguoi_dung')->user()->ma;
                $auth['ma_phong'] = $id;
                $auth['co_quyen'] = 1;
                $auth['ngay_tao'] = date('Y-m-d H:i:s');;
                ManagerRoleRoom::create($auth);
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
            if ($delete->hinh_anh == "") {
            } else {
                $img = 'admin/img/img_room/' . $delete->hinh_anh;
                if (file_exists($img)) {
                    unlink($img);
                }
            }
            return $delete->delete();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _update($data_update_room, $data_update_role_room, $id, $request)
    {
        DB::beginTransaction();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $room = $this->find($id);
            $data_update_room['ngay_cap_nhat'] = date('Y-m-d H:i:s');

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
                $get_image->move('admin/img/img_room', $new_image);

                $data_update_room['hinh_anh'] = $new_image;

                $pro = $this::find($id);
                if (!$pro->hinh_anh == "") {
                    $img = 'admin/img/img_room/' . $pro->hinh_anh;

                    if (file_exists($img)) {
                        unlink($img);
                    }
                }
            }

            $room->update($data_update_room);

            foreach ($data_update_role_room as $key => $item) {
                $role_room = RoleBorrowRoom::where('ma_phong', $id)->where('ma_vai_tro', $key)->first();
                $data['dang_ky_duyet'] = $item;
                $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
                $role_room->update($data);
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

    public function _get_by_id_and_check_roles($id)
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

        return $this->_get_by_id($id);
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

    public function _get_infor($id)
    {
        try {
            return $this->where('phong.ma', $id)
                ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
                ->select(
                    'phong.*',
                    'loai_phong.ten as ten_loai_phong',
                    'loai_phong.mo_ta as mo_ta_loai_phong',
                    DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )->first();
        } catch (Exception $e) {
            return false;
        }
    }

    public function _search_room($search_name_room, $search_type_room, $search_uses, $search_device)
    {

        //Tìm theo tên
        if (!$search_name_room) {
            $search_name_room = '%%';
        } else {
            $search_name_room = '%' . $search_name_room . '%';
        }
        $room_to_name = $this
            ->where('phong.hien_thi', true)
            ->where('phong.ten', 'like', $search_name_room)
            ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
            ->select(
                'phong.*',
                'loai_phong.ten as ten_loai_phong',
                'loai_phong.mo_ta as mo_ta_loai_phong',
                DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )
            ->orderBy('phong.ma', 'asc')
            ->get();

        //Tìm theo loại phòng
        if ($search_type_room != '') {
            $room_to_type_room = $this
                ->where('phong.hien_thi', true)
                ->where('phong.ma_loai_phong', $search_type_room)
                ->join('loai_phong', 'loai_phong.ma', '=', 'phong.ma_loai_phong')
                ->select(
                    'phong.*',
                    'loai_phong.ten as ten_loai_phong',
                    'loai_phong.mo_ta as mo_ta_loai_phong',
                    DB::raw('(DATE_FORMAT(phong.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                    DB::raw('(DATE_FORMAT(phong.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
                )
                ->orderBy('phong.ma', 'asc')
                ->get();
        } else {
            $room_to_type_room =  false;
        }


        // Tìm theo chức năng

        if (!$search_uses) {
            $room_to_uses = [];
        } else {
            // $room_to_uses = UsesRoom::whereIn('ma_chuc_nang', $search_uses)
            //     ->get();
            $list_room = UsesRoom::groupBy('ma_phong')->pluck('ma_phong');

            $list_uses = array();
            foreach ($list_room as $key => $item) {
                $uses_room = UsesRoom::where('ma_phong', $item)->get();
                $list_uses[$key]['id_room'] = $item;
                foreach ($uses_room as $key1 => $item1) {
                    $list_uses[$key]['ids_uses'][$key1] = $item1->ma_chuc_nang;
                }
            }

            $count = count($search_uses);
            foreach ($list_uses as $key => $item) {

                $temp = 0;
                foreach ($item['ids_uses'] as $key1 => $item1) {
                    foreach ($search_uses as $key2 => $item2) {
                        if ($item1 == $item2) {
                            $temp++;
                            break;
                        }
                    }
                }
                if ($temp < $count) {
                    unset($list_uses[$key]);
                }
            }
            $room_to_uses = $list_uses;
        }

        // Tìm theo thiết bị

        if (!$search_device) {
            $room_to_device = [];
        } else {
            // $room_to_device = DeviceRoom::whereIn('ma_thiet_bi', $search_device)
            //     ->get();
            $list_room = DeviceRoom::groupBy('ma_phong')->pluck('ma_phong');

            $list_device = array();
            foreach ($list_room as $key => $item) {
                $device_room = DeviceRoom::where('ma_phong', $item)->get();
                $list_device[$key]['id_room'] = $item;
                foreach ($device_room as $key1 => $item1) {
                    $list_device[$key]['ids_device'][$key1] = $item1->ma_thiet_bi;
                }
            }

            $count = count($search_device);
            foreach ($list_device as $key => $item) {

                $temp = 0;
                foreach ($item['ids_device'] as $key1 => $item1) {
                    foreach ($search_device as $key2 => $item2) {
                        if ($item1 == $item2) {
                            $temp++;
                            break;
                        }
                    }
                }
                if ($temp < $count) {
                    unset($list_device[$key]);
                }
            }
            $room_to_device = $list_device;
        }

        $room = array();
        // tên && loại
        if ($room_to_type_room) {
            foreach ($room_to_name as $key => $item) {
                foreach ($room_to_type_room as $key1 => $item1) {
                    if ($item->ma == $item1->ma) {
                        $room[$key] = $item;
                    }
                }
            }
        } else {
            $room = $room_to_name;
        }
        // chức năng

        if ($room_to_uses && count($room_to_uses) != 0) {
            $room_temp = array();
            foreach ($room_to_uses as $key1 => $item1) {
                foreach ($room as $key => $item) {
                    if ($item->ma == $item1['id_room']) {
                        $room_temp[$key] = $item;
                    }
                }
            }
            $room = $room_temp;
        } else {
            if (count($room_to_uses) == 0 && $search_uses) {
                $room = [];
            } else {
                $room = $room;
            }
        }

        // thiết bị
        if ($room_to_device && count($room_to_device) != 0) {
            $room_temp = array();
            foreach ($room_to_device as $key1 => $item1) {
                foreach ($room as $key => $item) {
                    if ($item->ma == $item1['id_room']) {
                        $room_temp[$key] = $item;
                    }
                }
            }
            $room = $room_temp;
        } else {
            if (count($room_to_device) == 0 && $search_device) {
                $room = [];
            } else {
                $room = $room;
            }
        }

        return $room;
    }

    public function _get_list_room()
    {
        $list_room = $this->get();
        $list = [];
        foreach ($list_room as $key => $value) {
            $list[$key] = $value->ten;
        }
        return $list;
    }
}
