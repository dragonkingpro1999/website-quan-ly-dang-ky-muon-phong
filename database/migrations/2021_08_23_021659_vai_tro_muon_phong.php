<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VaiTroMuonPhong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vai_tro_muon_phong', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_phong')->unsigned();
            $table->foreign('ma_phong')
                ->references('ma')
                ->on('phong')
                ->onDelete('cascade');
            $table->integer('ma_vai_tro')->unsigned();
            $table->foreign('ma_vai_tro')
                ->references('ma')
                ->on('vai_tro')
                ->onDelete('cascade');

            $table->integer('dang_ky_duyet');

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
        Schema::dropIfExists('vai_tro_muon_phong');
    }
}
