<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatDongSanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bat_dong_san', function (Blueprint $table) {
            $table->bigIncrements('idBDS');//Khóa chính

            
            $table->string('TieuDeBDS',255)->nullable();
            $table->string('TieuDeBDS_Slug',255)->nullable();
            $table->bigInteger('HinhThuc');
            $table->bigInteger('LoaiBDS');
            $table->string('AnhDaiDien',255)->nullable();
            $table->text('MoTaBDS')->nullable();
            $table->text('NoiDungBDS')->nullable();
            $table->float('DienTich',8,2)->unsigned();
            $table->bigInteger('GiaTienBDS')->unsigned();
            $table->string('GiaTienBDS_JS',100)->nullable();
            $table->string('DonVi',100)->nullable();
            $table->string('DiaChiBDS',255)->nullable();
            $table->float('MatTien',8,1)->unsigned()->nullable();
            $table->float('DuongVao',8,1)->unsigned()->nullable();
            $table->string('HuongNha',100)->nullable();
            $table->string('HuongBanCong',100)->nullable();
            $table->integer('SoTang')->unsigned()->nullable();
            $table->integer('SoPhongNgu')->unsigned()->nullable();
            $table->integer('SoToilet')->unsigned()->nullable();
            $table->text('NoiThat')->nullable();
            $table->string('ThongTinPhapLy',255)->nullable();
            $table->string('TenLienHe',100)->nullable();
            $table->string('DiaChiLienHe',200)->nullable();
            $table->string('DienThoai',11)->nullable();
            $table->string('emailUser',100)->nullable();
            $table->date('NgayBatDau');
            $table->date('NgayKetThuc');
            $table->string('ViewBDS',255)->nullable();
            $table->dateTime('ThoiGianTaoBDS')->nullable();
            $table->dateTime('ThoiGianSuaBDS')->nullable();
            $table->dateTime('ThoiGianXoaBDS')->nullable();
            $table->integer('HienThiBDS')->default(0);
            $table->bigInteger('TongTien')->default(0);
            $table->bigInteger('idUserPost')->unsigned()->nullable();
            $table->bigInteger('id_TinhThanh')->unsigned();//Khóa ngoại tinh thanh
            $table->bigInteger('id_QuanHuyen')->unsigned();//Khóa ngoại quan huyen
            $table->bigInteger('id_XaPhuong')->unsigned();//Khóa ngoại xa phuong
            $table->bigInteger('id_User')->unsigned();//Khóa ngoại users
            $table->bigInteger('id_LoaiTin')->unsigned();//Khóa ngoại loại tin

            $table->foreign('id_TinhThanh')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('id_QuanHuyen')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('id_XaPhuong')->references('id')->on('wards')->onDelete('cascade');
            $table->foreign('id_User')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_LoaiTin')->references('idLoaiTin')->on('loai_tin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bat_dong_san');
    }
}
