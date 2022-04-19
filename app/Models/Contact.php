<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;
use Auth;
use Mail;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'lien_he';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ten',
        'email',
        'chu_de',
        'noi_dung',
        'ma_nguoi_dung',

        'ma_nguoi_phan_hoi',
        'ten_nguoi_phan_hoi',
        'email_nguoi_phan_hoi',
        'noi_dung_nguoi_phan_hoi',

        'ngay_tao',
        'ngay_cap_nhat',
    ];

    public function _get_all()
    {
        return $this
            ->select(
                'lien_he.*',
                DB::raw('(DATE_FORMAT(lien_he.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(lien_he.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
            )
            ->orderBy('ngay_tao', 'asc')->get();
    }

    public function _insert($insert)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if (!$insert['ten']) {
            return response()->json([
                'status' => 'error_ten',
                'message' => "Tên không được trống!"
            ]);
        }
        if (!$insert['email']) {
            return response()->json([
                'status' => 'error_email',
                'message' => "Email không được trống!"
            ]);
        }
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        if (!(preg_match($pattern, $insert['email']) === 1)) {
            return response()->json([
                'status' => 'error_email',
                'message' => "Email không đúng định dạng (abc@gmail.com)!"
            ]);
        }

        if (!$insert['chu_de']) {
            return response()->json([
                'status' => 'error_chu_de',
                'message' => "Chủ đề không được trống!"
            ]);
        }
        if (!$insert['noi_dung']) {
            return response()->json([
                'status' => 'error_noi_dung',
                'message' => "Nội dung không được trống!"
            ]);
        }

        try {
            $insert['ngay_tao'] = date('Y-m-d H:i:s');
            $this->create($insert);
            return response()->json([
                'status' => 'success',
                'message' => "Câu hỏi đã được ghi lại, chúng tôi sẽ trả lời sớm nhất qua mail. Vui lòng kiểm tra mail thường xuyên!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Có lỗi xảy ra vui lòng thử lại!"
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

    public function _update($data, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        try {
            $update = $this->find($id);
            $data['ma_nguoi_phan_hoi'] = Auth::guard('nguoi_dung')->user()->ma;
            $data['ten_nguoi_phan_hoi'] = Auth::guard('nguoi_dung')->user()->ten;
            $data['email_nguoi_phan_hoi'] = Auth::guard('nguoi_dung')->user()->email;
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');

            $update->update($data);

            $mail_info = $this->find($id);

            $mail = [
                'chu_de' => $mail_info->chu_de,
                'noi_dung' => $mail_info->noi_dung,
                'ten_nguoi_phan_hoi' => $mail_info->ten_nguoi_phan_hoi,
                'email_nguoi_phan_hoi' => $mail_info->email_nguoi_phan_hoi,
                'noi_dung_nguoi_phan_hoi' => $mail_info->noi_dung_nguoi_phan_hoi,
                'ngay_tao' => $mail_info->ngay_tao,
            ];

            $info = [
                'title' => 'Phản hồi liên hệ: ' . $mail_info->chu_de,
                'to_mail' => $mail_info->email,
                'to_name' => $mail_info->ten,
            ];
            $this->send_mail_admin($mail, 'pages.email.mail_contact_reply', $info);
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

    public function send_mail_admin($data, $email_blade_php, $info)
    {
        $mail_setting = $this->_get_setting_mail();
        if ($info['to_mail'] != '') {
            Mail::send($email_blade_php, $data, function ($message) use ($info, $mail_setting) {
                $message->from($mail_setting->email, $mail_setting->ten);
                $message->to($info['to_mail'], $info['to_name']);
                $message->subject($info['title']);
            });
        }
    }
    public function _get_setting_mail()
    {
        return SettingMail::find(1);
    }
}
