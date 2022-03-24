<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('idRoleUser'); //Khóa chính

            $table->bigInteger('role_idRole')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            // $table->foreign('id_Role')->references('idRole')->on('role')->onDelete('cascade');
            // $table->foreign('id_User')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
