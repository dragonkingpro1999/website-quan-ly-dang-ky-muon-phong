<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhanHoiPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_hoi_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->bigInteger('ma_nguoi_dung')->unsigned();
            $table->foreign('ma_nguoi_dung')
                ->references('ma')
                ->on('nguoi_dung');
            // ->onDelete('cascade');
            $table->bigInteger('ma_nguoi_tra_loi')->unsigned()->nullable();
            $table->foreign('ma_nguoi_tra_loi')
                ->references('ma')
                ->on('nguoi_dung');
            // ->onDelete('cascade');
            $table->bigInteger('ma_muon_phong')->unsigned();
            $table->foreign('ma_muon_phong')
                ->references('ma')
                ->on('muon_phong');
            // ->onDelete('cascade');
            $table->text('noi_dung');
            $table->integer('da_xu_ly'); // 1: chưa xử lý 2: đã xử lý 3: ko cần xử lý
            $table->text('noi_dung_tra_loi')->nullable();
            $table->dateTime('ngay_xu_ly')->nullable();
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
        Schema::dropIfExists('phan_hoi_phong');
    }
}
