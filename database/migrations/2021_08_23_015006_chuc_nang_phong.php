<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChucNangPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuc_nang_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_phong')->unsigned();
                $table->foreign('ma_phong')
                    ->references('ma')
                    ->on('phong');
                    // ->onDelete('cascade');
            $table->integer('ma_chuc_nang')->unsigned();
                $table->foreign('ma_chuc_nang')
                    ->references('ma')
                    ->on('chuc_nang');
                    // ->onDelete('cascade');

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
        Schema::dropIfExists('chuc_nang_phong');
    }
}
