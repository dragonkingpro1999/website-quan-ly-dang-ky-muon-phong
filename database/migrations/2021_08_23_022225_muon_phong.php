<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MuonPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muon_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_phong')->unsigned();
            $table->foreign('ma_phong')
                ->references('ma')
                ->on('phong');
            // ->onDelete('cascade');
            $table->bigInteger('ma_nguoi_dung')->unsigned();
            $table->foreign('ma_nguoi_dung')
                ->references('ma')
                ->on('nguoi_dung');
            // ->onDelete('cascade');

            $table->text('chuc_nang')->nullable();
            $table->text('ly_do_muon')->nullable();
            // $table->text('tinh_trang_truoc_khi_muon')->nullable();
            // $table->text('tinh_trang_sau_khi_muon')->nullable();

            $table->date('ngay_muon');
            $table->time('thoi_gian_bat_dau_muon');
            $table->time('thoi_gian_ket_thuc_muon');

            $table->integer('trang_thai')->default(1);
            $table->bigInteger('ma_nguoi_duyet')->unsigned()->nullable();
            $table->foreign('ma_nguoi_duyet')
                ->references('ma')
                ->on('nguoi_dung');
            $table->dateTime('ngay_duyet')->nullable();
            $table->text('ly_do_huy')->nullable();
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
        Schema::dropIfExists('muon_phong');
    }
}
