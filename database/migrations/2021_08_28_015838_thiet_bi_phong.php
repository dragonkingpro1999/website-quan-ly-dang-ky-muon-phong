<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThietBiPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thiet_bi_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_phong')->unsigned();
            $table->foreign('ma_phong')
                ->references('ma')
                ->on('phong');
            // ->onDelete('cascade');
            $table->integer('ma_thiet_bi')->unsigned();
            $table->foreign('ma_thiet_bi')
                ->references('ma')
                ->on('thiet_bi');
            // ->onDelete('cascade');

            $table->integer('so_luong')->default(0);
            $table->integer('so_luong_hu')->default(0);
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
        Schema::dropIfExists('thiet_bi_phong');
    }
}
