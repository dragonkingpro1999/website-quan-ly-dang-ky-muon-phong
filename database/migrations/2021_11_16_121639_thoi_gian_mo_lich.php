<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThoiGianMoLich extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_mo_hoc_ky', function (Blueprint $table) {
            $table->increments('ma');

            $table->integer('ma_nam_hoc')->unsigned();
            $table->foreign('ma_nam_hoc')
                ->references('ma')
                ->on('nam_hoc');
            // ->onDelete('cascade');
            $table->integer('ma_hoc_ky')->unsigned();
            $table->foreign('ma_hoc_ky')
                ->references('ma')
                ->on('hoc_ky');
            // ->onDelete('cascade');

            $table->date('thoi_gian_bat_dau');
            $table->date('thoi_gian_ket_thuc');

            $table->boolean('trang_thai');
            $table->boolean('mac_dinh');

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
        Schema::dropIfExists('tg_mo_hoc_ky');
    }
}
