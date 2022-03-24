<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class InfoUserController extends Controller
{
    //
    public function info_user(){
        return view('frontend.trangcanhan');
    }

    public function GetInfoUser(){
        $idUser=Auth::user()->id;
        $user=User::where('id',$idUser)
                    ->join('role_user','role_user.user_id','=','user.id')
                    ->leftjoin('role','role.idRole','=','role_user.role_idRole') 
                    ->first();

        return response()->json([
            'idUser'=>$idUser,
            'user'=>$user,
        ],200);
    }

    public function EditUser(Request $request){
        $messages=[
            'required'=>'Không được để trống!',
            'txt_sdt_user.numeric'=>'Phải là ký tự số',
            'txt_email_user.email'=>'Email không đúng định dạng',
            'txt_email_user.unique'=>'Email đã tồn tại',
        ];
        $validate=Validator::make(
            $request->all(),
            [
                'txt_ho_user'=>'required',
                'txt_ten_user'=>'required',
                'txt_sdt_user'=>'required|numeric',
                'txt_gioitinh_user'=>'required',
                'txt_diachi_user'=>'required',
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
        }
        else{
            $idUser=Auth::user()->id;
            $user=User::find($idUser);
           
            $user->Ho=$request->txt_ho_user;
            $user->Ten=$request->txt_ten_user;
            $user->Phone=$request->txt_sdt_user;
            $user->GioiTinh=$request->txt_gioitinh_user;
            $user->DiaChi=$request->txt_diachi_user;
            $user->email=$request->txt_email_user;
            
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $user->ThoiGianSuaUs=$dateTime;
            $user->save();

            $response=['success'=>'Cập nhật thành công!'];
        }
        return response()->json([
            $response,
        ],200);
    }

    public function EditPassword(Request $request){
        $messages=[
            'required'=>'*Không được để trống!',
            'password.min'=>'*Password phải lớn hơn 8 ký tự',
            'password.confirmed'=>'*Mật khẩu không trùng khớp',

        ];
        $validate=Validator::make(
            $request->all(),
            [
                'password_old'=>'required',
                'password'=>'required|confirmed|min:8',
               
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
        }
        else{

            $idUser=Auth::user()->id;
            $pass=User::find($idUser);
            
              if(Hash::check($request->password_old,$pass->password))
              {
    
                $user=User::find($idUser);
                $user->password=bcrypt($request->password);
                $user->save();
              
                $response=['success'=>'Đổi mật khẩu thành công'];  
                
              }else{
                  $response=['err'=>'*Mật khẩu cũ không đúng'];
              }

                    
              
        }
        return response()->json([
            $response,
            
        ],200);
    }

    
}
