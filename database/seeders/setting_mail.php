<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class setting_mail extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MAIL_USERNAME=wdkmp2021@gmail.com
        // MAIL_PASSWORD=wdkmp2021@123


        $today = "2021-05-10 08:00:00";
        DB::table('setting_mail')->insert([
            [
                'ma' => 1,
                'email' => 'wdkmp2021@gmail.com',
                'password' => bcrypt('wdkmp2021@123'),
                'ten' => 'Khánh',
                'ngay_tao' => $today
            ],
        ]);
    }
}
