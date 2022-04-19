<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CaiDatLienHe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cai_dat_lien_he', function (Blueprint $table) {
            $table->increments('ma');

            $table->text('dia_chi');
            $table->string('email');
            $table->string('so_dien_thoai');

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
        Schema::dropIfExists('cai_dat_lien_he');
    }
}
