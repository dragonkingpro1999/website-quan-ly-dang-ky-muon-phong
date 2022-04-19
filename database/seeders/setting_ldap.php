<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class setting_ldap extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = "2021-05-10 08:00:00";
        DB::table('setting_ldap')->insert([
            [
                'ma' => 1,
                'hosts'            => '127.0.0.1',
                'port'             => 10389,
                'use_ssl'          => false,
                'use_tls'          => false,
                'version'          => 3,
                'timeout'          => 5,
                'follow_referrals' => false,
                'ngay_tao' => $today
            ],
        ]);
    }
}
