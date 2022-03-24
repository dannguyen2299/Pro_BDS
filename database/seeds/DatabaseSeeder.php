<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LoaiTin::class);
        $this->call(DanhMuc::class);
        $this->call(Role::class);
        $this->call(UserSeed::class);
    }
}
