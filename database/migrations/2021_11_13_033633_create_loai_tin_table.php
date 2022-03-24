<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaiTinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_tin', function (Blueprint $table) {
            $table->bigInteger('idLoaiTin')->unsigned(); //Khóa chính
            $table->primary('idLoaiTin');
            $table->string('LoaiTin',50)->nullable();
            $table->bigInteger('GiaTien')->unsigned()->nullable();
            $table->dateTime('ThoiGianTaoLT')->nullable();
            $table->dateTime('ThoiGianSuaLT')->nullable();
            $table->dateTime('ThoiGianXoaLT')->nullable();
            $table->tinyInteger('HienThiLT')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loai_tin');
    }
}
