<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CaiDatThoiGianMuonPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cai_dat_thoi_gian_muon_phong', function (Blueprint $table) {
            $table->increments('ma');

            $table->integer('so_gio_cach_thoi_diem_hien_tai');
            $table->integer('so_phut_muon_it_nhat');

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
        Schema::dropIfExists('cai_dat_thoi_gian_muon_phong');
    }
}
