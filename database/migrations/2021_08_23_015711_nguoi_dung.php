<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NguoiDung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoi_dung', function (Blueprint $table) {
            $table->bigIncrements('ma');

            $table->integer('ma_vai_tro')->unsigned();
            $table->foreign('ma_vai_tro')
                ->references('ma')
                ->on('vai_tro');
            // ->onDelete('cascade');

            $table->string('tai_khoan', 50)->unique();
            $table->string('password', 200);
            $table->string('ten', 50);
            $table->string('email')->unique()->nullable();
            $table->string('so_dien_thoai', 11)->unique()->nullable();
            // $table->rememberToken();
            $table->integer('khoa_tai_khoan');

            $table->integer('ma_don_vi')->unsigned()->nullable();
            $table->foreign('ma_don_vi')
                ->references('ma')
                ->on('don_vi');

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
        Schema::dropIfExists('nguoi_dung');
    }
}
