<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SettingLdap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_ldap', function (Blueprint $table) {
            $table->increments('ma');

            $table->string('hosts');
            $table->integer('port');
            $table->boolean('use_ssl');
            $table->boolean('use_tls');
            $table->integer('version');
            $table->integer('timeout');
            $table->boolean('follow_referrals');

            $table->dateTime('ngay_tao');
            $table->dateTime('ngay_cap_nhat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_ldap');
    }
}
