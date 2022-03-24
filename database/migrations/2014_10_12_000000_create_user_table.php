<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id'); //Khóa chính

            $table->string('Ho',20);
            $table->string('Ten',20);
            $table->string('email',255)->unique();
            $table->string('Phone',11);
            $table->string('DiaChi',100);
            $table->string('GioiTinh',10);
            $table->bigInteger('SoTien')->unsigned()->default(50000);
            $table->string('AnhAvatar',255)->nullable();
            $table->string('password',255);
            $table->string('user_token',50)->nullable();
            $table->dateTime('ThoiGianTaoUs')->nullable();
            $table->dateTime('ThoiGianSuaUs')->nullable();
            $table->dateTime('ThoiGianXoaUs')->nullable();
            $table->tinyInteger('HienThiUs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
