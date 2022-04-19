<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phong', function (Blueprint $table) {
            $table->increments('ma');

            $table->integer('ma_loai_phong')->unsigned();
            $table->foreign('ma_loai_phong')
                ->references('ma')
                ->on('loai_phong');
            // ->onDelete('cascade');

            $table->string('ten', 50)->unique();
            $table->integer('suc_chua');
            $table->boolean('trang_thai');
            $table->boolean('hien_thi');
            // $table->string('vi_tri', 200)->nullable();
            $table->string('mo_ta', 200)->nullable();
            $table->text('hinh_anh')->nullable();

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
        Schema::dropIfExists('phong');
    }
}
