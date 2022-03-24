<?php

use Illuminate\Database\Seeder;

class LoaiTin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai_tin')->delete();
        DB::table('loai_tin')->insert([
            ['idLoaiTin'=>20000,'LoaiTin'=>'Tin thường','GiaTien'=>20000],
            ['idLoaiTin'=>50000,'LoaiTin'=>'Tin VIP','GiaTien'=>50000],
        ]);

    }
}
