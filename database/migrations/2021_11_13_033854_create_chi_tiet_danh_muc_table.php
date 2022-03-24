<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietDanhMucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_danh_muc', function (Blueprint $table) {
            $table->bigIncrements('idTinTucDanhMuc'); //Khóa chính
            
        

            $table->bigInteger('id_DanhMuc')->unsigned();//Khóa ngoại danh mục
            $table->bigInteger('id_TinTuc')->unsigned(); //Khóa ngoại tin tức

            $table->foreign('id_DanhMuc')->references('idDanhMuc')->on('danh_muc')->onDelete('cascade');
            $table->foreign('id_TinTuc')->references('idTinTuc')->on('tin_tuc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chi_tiet_danh_muc');
    }
}
