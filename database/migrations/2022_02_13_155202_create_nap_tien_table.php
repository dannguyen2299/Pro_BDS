<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNapTienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nap_tien', function (Blueprint $table) {
            $table->bigIncrements('idNapTien');
            $table->bigInteger('SoTienNap')->unsigned()->nullable();
            $table->string('MaXacNhan',255)->nullable();
            $table->string('AnhNapTien',255)->nullable();
            $table->integer('Status')->unsigned()->nullable();
            $table->dateTime('ThoiGianNT')->nullable();

            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('user')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nap_tien');
    }
}
