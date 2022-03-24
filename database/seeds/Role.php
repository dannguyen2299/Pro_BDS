<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role')->delete();
        DB::table('role')->insert([
            ['idRole'=>1,'TenQuyen'=>'Admin','MoTa'=>'Admin'],
            ['idRole'=>2,'TenQuyen'=>'Nhân viên','MoTa'=>'Nhân viên'],
            ['idRole'=>3,'TenQuyen'=>'Khách hàng','MoTa'=>'Khách hàng'],
        ]);
    }
}
