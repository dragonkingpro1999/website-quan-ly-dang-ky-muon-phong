<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PhanQuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_quyen', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_quyen')->unsigned();
            $table->foreign('ma_quyen')
                ->references('ma')
                ->on('quyen')
                ->onDelete('cascade');
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
        Schema::dropIfExists('phan_quyen');
    }
}
