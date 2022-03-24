<?php

use Illuminate\Database\Seeder;
use App\models\Role;
use App\User;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //   User::truncate();

        $adminRole=Role::where('TenQuyen','Admin')->first();
        $employyRole=Role::where('TenQuyen','Nhân viên')->first();

        $guestRole=Role::where('TenQuyen','Khách hàng')->first();

        $admin=User::create([
            'Ho'=>'Trần Thanh',
            'Ten'=>'Duy Admin',
            'email'=>'thanhduyadmin@gmail.com',
            'Phone'=>'0123456789',
            'DiaChi'=>'Ha Noi',
            'GioiTinh'=>'Nam',
            'SoTien'=>30000,
            'AnhAvatar'=>'no-img.jpg',
            'password'=>bcrypt('123456789'),

        ]);

        $employee=User::create([
            'Ho'=>'Trần Thanh',
            'Ten'=>'Duy Employee',
            'email'=>'thanhduyemployee@gmail.com',
            'Phone'=>'0123456789',
            'DiaChi'=>'Ha Noi',
            'GioiTinh'=>'Nam',
            'SoTien'=>30000,
            'AnhAvatar'=>'no-img.jpg',
            'password'=>bcrypt('123456789'),

        ]);

        $guest=User::create([
            'Ho'=>'Trần Thanh',
            'Ten'=>'Duy Guest',
            'email'=>'thanhduyguest@gmail.com',
            'Phone'=>'0123456789',
            'DiaChi'=>'Ha Noi',
            'GioiTinh'=>'Nam',
            'SoTien'=>30000,
            'AnhAvatar'=>'no-img.jpg',
            'password'=>bcrypt('123456789'),

        ]);

        $admin->role()->attach($adminRole);
        $employee->role()->attach($employyRole);
        $guest->role()->attach($guestRole);

    }
    
}
