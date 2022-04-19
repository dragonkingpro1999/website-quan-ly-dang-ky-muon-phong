<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChucNang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuc_nang', function (Blueprint $table) {
            $table->increments('ma');

            $table->string('ten', 50)->unique();
            $table->string('mo_ta', 200)->nullable();

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
        Schema::dropIfExists('chuc_nang');
    }
}
