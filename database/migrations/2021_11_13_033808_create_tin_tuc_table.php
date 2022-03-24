<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinTucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tin_tuc', function (Blueprint $table) {
            $table->bigIncrements('idTinTuc');//Khóa chính

            $table->string('TieuDeTinTuc',200)->nullable();
            $table->string('TieuDeTinTuc_Slug',255)->nullable();
            $table->text('MoTaTinTuc')->nullable();
            $table->text('NoiDungTinTuc')->nullable();
            $table->string('ViewTinTuc',255)->nullable();
            $table->string('AnhDaiDien',255)->nullable();
            $table->dateTime('ThoiGianTaoTT')->nullable();
            $table->dateTime('ThoiGianSuaTT')->nullable();
            $table->dateTime('ThoiGianXoaTT')->nullable();
            $table->tinyInteger('HienThiTT')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tin_tuc');
    }
}
