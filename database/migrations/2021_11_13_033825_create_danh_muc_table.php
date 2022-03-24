<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDanhMucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danh_muc', function (Blueprint $table) {
            $table->bigIncrements('idDanhMuc');//Khóa chính
            $table->bigInteger('idDanhMucCha')->nullable();
            $table->string('TieuDeDanhMuc',255)->nullable();
            $table->string('TieuDeDanhMuc_Slug',255)->nullable();
            
            $table->string('MoTaDanhMuc',100)->nullable();
            $table->string('NoiDungDanhMuc',200)->nullable();
            $table->integer('ViTriTrenMainMenu')->unsigned()->nullable();
            $table->integer('HienThiTrenMainMenu')->unsigned()->nullable();
            $table->integer('ViTriTrenHeadMenu')->unsigned()->nullable();
            $table->integer('HienThiTrenHeadMenu')->unsigned()->nullable();
            $table->dateTime('ThoiGianTaoDM')->nullable();
            $table->dateTime('ThoiGianSuaDM')->nullable();
            $table->dateTime('ThoiGianXoaDM')->nullable();
            $table->tinyInteger('HienThiDM')->nullable();

             

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danh_muc');
    }
}
