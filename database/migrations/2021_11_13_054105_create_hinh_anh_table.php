<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhAnhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinh_anh', function (Blueprint $table) {
            $table->bigIncrements('idHinhAnh');//Khóa chính

            $table->string('TenAnh',255)->nullable();
            $table->dateTime('ThoiGianTaoHA')->nullable();
            $table->dateTime('ThoiGianSuaHA')->nullable();
            $table->dateTime('ThoiGianXoaHA')->nullable();
            $table->tinyInteger('HienThiHA')->nullable();

            $table->bigInteger('id_BDS')->unsigned();//Khóa ngoại bds
            $table->foreign('id_BDS')->references('idBDS')->on('bat_dong_san')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hinh_anh');
    }
}
