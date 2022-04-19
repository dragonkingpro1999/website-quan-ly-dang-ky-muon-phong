<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use DB;

class SettingMail extends Model
{
    use HasFactory;

    protected $table = 'setting_mail';

    protected $primaryKey = 'ma';

    public $timestamps = false;

    protected $fillable = [
        'ten',
        'email',
        'password',
        'ngay_tao',
        'ngay_cap_nhat',
    ];

    private $_envPath;

    public function __construct()
    {
        $this->_envPath = base_path('.env');
    }

    public function _get_all()
    {
        return $this->orderBy('ma', 'desc')
            ->select(
                'setting_mail.*',
                DB::raw('(DATE_FORMAT(setting_mail.ngay_tao,"%H:%i %d-%m-%Y")) as ngay_tao'),
                DB::raw('(DATE_FORMAT(setting_mail.ngay_cap_nhat,"%H:%i %d-%m-%Y")) as ngay_cap_nhat')
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
        DB::beginTransaction();
        try {
            $update = $this->find($id);
            $password = $data['password'];
            $data['password'] = ($password);
            $data['ngay_cap_nhat'] = date('Y-m-d H:i:s');
            $update->update($data);
            $this->_change_file_env($data['email'], $password);
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

    public function _change_file_env($email, $password)
    {
        $envFileData =
            'APP_NAME=Laravel' . "\n" .
            'APP_ENV=local' . "\n" .
            'APP_KEY=base64:5Dh1UzTTByjLnyuTS+6bzmTrZbswmyKAMtPct/SmNW0=' . "\n" .
            'APP_DEBUG=true' . "\n" .
            'APP_URL=http://website-quan-ly-dang-ky-muon-phong.test' . "\n" . "\n" .

            'LOG_CHANNEL=stack' . "\n" .
            ' LOG_LEVEL=debug' . "\n" . "\n" .

            'DB_CONNECTION=mysql' . "\n" .
            'DB_HOST=127.0.0.1' . "\n" .
            'DB_PORT=3306' . "\n" .
            'DB_DATABASE=website_quan_ly_dang_ky_muon_phong' . "\n" .
            'DB_USERNAME=root' . "\n" .
            'DB_PASSWORD=' . "\n" . "\n" .

            'BROADCAST_DRIVER=log' . "\n" .
            'CACHE_DRIVER=file' . "\n" .
            'FILESYSTEM_DRIVER=local' . "\n" .
            'QUEUE_CONNECTION=sync' . "\n" .
            'SESSION_DRIVER=file' . "\n" .
            'SESSION_LIFETIME=120' . "\n" . "\n" .

            'MEMCACHED_HOST=127.0.0.1' . "\n" . "\n" .

            'REDIS_HOST=127.0.0.1' . "\n" .
            'REDIS_PASSWORD=null' . "\n" .
            'REDIS_PORT=6379' . "\n" . "\n" .

            'MAIL_MAILER=smtp' . "\n" .
            ' MAIL_HOST=smtp.gmail.com' . "\n" .
            'MAIL_PORT=587' . "\n" .
            'MAIL_USERNAME=' . $email . "\n" .
            'MAIL_PASSWORD=' . $password . "\n" .
            'MAIL_ENCRYPTION=tls' . "\n" .
            'MAIL_FROM_ADDRESS=null' . "\n" .
            'MAIL_FROM_NAME="${APP_NAME}"' . "\n" . "\n" .

            'AWS_ACCESS_KEY_ID=' . "\n" .
            'AWS_SECRET_ACCESS_KEY=' . "\n" .
            'AWS_DEFAULT_REGION=us-east-1' . "\n" .
            'AWS_BUCKET=' . "\n" .
            'AWS_USE_PATH_STYLE_ENDPOINT=false' . "\n" . "\n" .

            'PUSHER_APP_ID=' . "\n" .
            'PUSHER_APP_KEY=' . "\n" .
            'PUSHER_APP_SECRET=' . "\n" .
            'PUSHER_APP_CLUSTER=mt1' . "\n" . "\n" .

            'MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"' . "\n" .
            'MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"' . "\n";

        file_put_contents($this->_envPath, $envFileData);
    }
}
