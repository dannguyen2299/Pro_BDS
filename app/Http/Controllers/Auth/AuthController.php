<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\models\RoleUser;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function Login(){
        return view('frontend.login.login');
    }
 
    public function login_auth(Request $request)
    {
        $messages=[
            'required'=>'*Không được để trống!',
            'email.email'=>'*Email không đúng định dạng',
            'password.min'=>'*Password phải lớn hơn 8 ký tự.',

        ];

        $validate=Validator::make(
            $request->all(),
            [
                'email'=>'required|email',
                'password'=>'required|min:8',
            ],
            $messages
        );

        if($validate->fails()){
            $response=$validate->messages();  
        }
        else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $response=['success'=>'Đăng nhập thành công!'];
            }
            else{
                $response=['error'=>'*Tên tài khoản hoặc mật khẩu không đúng!'];
            }
        }
        return response()->json([
            $response,
        ],200);
    }




    function Signup(){

        return view('frontend.signup.signup');
    }

    public function Register(Request $request)
    {
        $messages=[
            'required'=>'Không được để trống!',
            'txt_sdt.numeric'=>'Phải là ký tự số',
            'txt_email.email'=>'Email không đúng định dạng',
            'txt_email.unique'=>'Email đã tồn tại',
            'password.min'=>'Password phải lớn hơn 8 ký tự.',
            'password.confirmed'=>'Mật khẩu không trùng khớp',


        ];

        $validate=Validator::make(
            $request->all(),
            [
                'txt_ho'=>'required',
                'txt_ten'=>'required',
                'txt_sdt'=>'required|numeric',
                'txt_gioitinh'=>'required',
                'txt_diachi'=>'required',
                'txt_email'=>'required|email|unique:user,email',
                'password'=>'required|confirmed|min:8',
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
        }
        else{
            $user=new User;
            $user->Ho=$request->txt_ho;
            $user->Ten=$request->txt_ten;
            $user->Phone=$request->txt_sdt;
            $user->GioiTinh=$request->txt_gioitinh;
            $user->DiaChi=$request->txt_diachi;
            $user->email=$request->txt_email;
            $user->password=bcrypt($request->password);
            $user->AnhAvatar='avatar.jpg';
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $user->ThoiGianTaoUs=$dateTime;
            $user->save();

            $idUser=$user->id;
            $user_role=new RoleUser;
            $user_role->user_id=$idUser;
            $user_role->role_idRole=3;
            $user_role->save();

            $response=['success'=>'Đăng ký thành công!'];
        }

         return response()->json([
            $response,
        ],200);
    }
   
    public function Logout(){
        Auth::logout();
        return redirect('/');
    }


    public function validate_email(Request $request){
        $email=User::where('email',$request->txt_email)->first('email');
        if($email){
            $return =false;
        }
        else{
            $return=true;
        }
        echo json_encode($return);
        exit;
    }

    public function validate_phone(Request $request){
        $phone=User::where('Phone',$request->txt_sdt)->first('Phone');
        if($phone){
            $return =false;
        }
        else{
            $return=true;
        }
        echo json_encode($return);
        exit;
    }


    
}
