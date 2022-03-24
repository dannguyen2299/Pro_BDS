<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietBatDongSanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_bat_dong_san', function (Blueprint $table) {
            $table->bigIncrements('idChiTietBDS');//Khóa chính


        

            $table->bigInteger('id_DanhMuc')->unsigned();//Khóa ngoại danh mục
            $table->bigInteger('id_BDS')->unsigned();//Khóa ngoại bds

            $table->foreign('id_DanhMuc')->references('idDanhMuc')->on('danh_muc')->onDelete('cascade');
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
        Schema::dropIfExists('chi_tiet_bat_dong_san');
    }
}
