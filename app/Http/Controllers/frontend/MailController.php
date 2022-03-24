<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\User;
class MailController extends Controller
{
    public function forgetPass(){
        return view('frontend.forgotPass');
    }

    public function recoverPass(Request $request){

        $data=$request->all();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail="Lấy lại mật khẩu".' '.$now;
        $user=User::where('email','=',$data['email_account'])->get();
        foreach($user as $key=>$value){
            $id_user=$value->id;
        }
        if($user){
            $count_user=$user->count();
            if($count_user==0){
                return redirect()->back()->with('err','Email chưa được đăng ký');
            }
            else{
                $token_random=Str::random();
                $user=User::find($id_user);
                $user->user_token=$token_random;
                $user->save();

                // Send mail
                $to_mail=$data['email_account'];
                $link_reset_pass=url('/update-new-pass?email='.$to_mail.'&token='.$token_random);
                $data=array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account']);

                Mail::send('frontend.forgotPass.forgot_pass_notify',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);
                });

                return redirect()->back()->with('message','Gửi mail thành công! Vào email để reset mật khẩu');
            }
        }
    }

    public function update_new_pass(){
        return view('frontend.forgotPass.new_pass');
    }

    public function update_pass(Request $request){
        $data=$request->all();
        $token_random=Str::random();
        $user=User::where('email','=',$data['email'])->where('user_token','=',$data['token'])->get();
        $count_user=$user->count();
        if($count_user>0){
            foreach($user as $key=>$value){
                $id_user=$value->id;
            }
            $user_update=User::find($id_user);
            $user_update->password=bcrypt($data['new_pass']);
            $user_update->user_token=$token_random;
            $user_update->save();

            return redirect('dang-nhap')->with('message','Mật khẩu đã được cập nhật. Vui lòng đăng nhập lại.');
        }
        else{
            return redirect('quen-mat-khau')->with('err','Link đã quá hạn, vui lòng nhập lại email.');
        }
    }
}
