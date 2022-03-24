<?php

namespace App\Http\Controllers\frontend;
use App\User;
use App\models\NapTien;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class NapTienController extends Controller
{
    //

    public function recharge(Request $request)
    {
        $messages=[
            'required'=>'*Không được để trống',
            'same'=>'*Mã xác nhận không trùng khớp',
        ];
        $validate=Validator::make(
            $request->all(),
            [
                'txt_manaptien'=>'required|same:txt_maxacnhan',
            ],
            $messages
        );

        if($validate->fails()){
            $response=$validate->messages();
        }
        else{
            $naptien=new NapTien();
            $naptien->SoTienNap=$request->txt_moneyHidden;
            $naptien->MaXacNhan=$request->txt_maxacnhan;
            
            if($request->hasFile('select_file_bank')){
                $image=$request->file('select_file_bank');
                $new_name=rand(1,10000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('frontend/assets/image/avatar/users'),$new_name);
                $naptien->AnhNapTien=$new_name;
            }
            else{
                $naptien->AnhNapTien='no-img.jpg';
            }
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $naptien->ThoiGianNT=$dateTime;
            $naptien->idUser=Auth::user()->id;

            $naptien->save();

            $response=['success'=>'Nạp tiền thành công! Tiền sẽ chuyển vào tài khoản sớm nhất.'];

        }
        return response()->json([
            $response,
        ],200);
    }
}
