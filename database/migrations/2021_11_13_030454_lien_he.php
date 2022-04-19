<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LienHe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lien_he', function (Blueprint $table) {
            $table->increments('ma');

            $table->string('ten', 50);
            $table->string('email');
            $table->string('chu_de');
            $table->text('noi_dung');

            $table->bigInteger('ma_nguoi_dung')->unsigned()->nullable();
            $table->foreign('ma_nguoi_dung')
                ->references('ma')
                ->on('nguoi_dung')
                ->onDelete('cascade');

            $table->bigInteger('ma_nguoi_phan_hoi')->unsigned()->nullable();
            $table->foreign('ma_nguoi_phan_hoi')
                ->references('ma')
                ->on('nguoi_dung')
                ->onDelete('cascade');
            $table->string('ten_nguoi_phan_hoi', 50)->nullable();
            $table->string('email_nguoi_phan_hoi')->nullable();
            $table->text('noi_dung_nguoi_phan_hoi')->nullable();

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
        Schema::dropIfExists('lien_he');
    }
}
