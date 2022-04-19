<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuanLyPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quan_ly_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->bigInteger('ma_nguoi_dung')->unsigned();
            $table->foreign('ma_nguoi_dung')
                ->references('ma')
                ->on('nguoi_dung')
                ->onDelete('cascade');
            $table->bigInteger('ma_nguoi_cap')->unsigned()->nullable();
            $table->foreign('ma_nguoi_cap')
                ->references('ma')
                ->on('nguoi_dung')
                ->onDelete('cascade');
            $table->integer('ma_phong')->unsigned();
            $table->foreign('ma_phong')
                ->references('ma')
                ->on('phong')
                ->onDelete('cascade');
            $table->integer('co_quyen');
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
        Schema::dropIfExists('quan_ly_phong');
    }
}
