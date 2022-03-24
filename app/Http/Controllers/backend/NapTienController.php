<?php

namespace App\Http\Controllers\backend;
use Auth;
use App\User;
use App\models\NapTien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class NapTienController extends Controller
{
    //

    public function View_Recharge()
    {
        return view('backend.nap-tien.list_nap_tien');
    }

    public function List_Recharge()
    {
        $naptien=NapTien::join('user','user.id','=','nap_tien.idUser')
                        ->orderBy('idNapTien','desc')
                        ->get();
        return Datatables::of($naptien)
        ->addIndexColumn()
        ->addColumn(__('hoten'),function($naptien){
            return $naptien->Ho.' '.$naptien->Ten;
        })
        ->addColumn(__('hinhanh'),function($naptien){
            return '<img src="../frontend/assets/image/avatar/users/'.$naptien->AnhNapTien.'" alt="'.$naptien->AnhNapTien.'" style="width:100%;">';
        })

        ->addColumn(__('giatien'),function($naptien){
            return number_format($naptien->SoTienNap).' đ';
        })
        ->addColumn(__('ngay'),function($naptien){
            Carbon::setLocale('vi');
            $dateTime=Carbon::create($naptien->ThoiGianNT,'Asia/Ho_Chi_Minh');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            return $naptien->ThoiGianNT.'</br>('.$dateTime->diffForHumans($now).')';
        })
        ->addColumn(__('hanhdong'),function($naptien){
            if($naptien->Status==null){
                return '<a onclick=btn_recharge('.$naptien->idNapTien.') class="btn btn-primary">Nạp tiền</a>
                        <a onclick=btn_del_recharge('.$naptien->idNapTien.') class="btn btn-danger">Xóa</a>';
            }
            else{
                return '<span class="badge bg-gradient-red">Đã nạp tiền</span>
                        <a onclick=btn_del_recharge('.$naptien->idNapTien.') class="btn btn-danger">Xóa</a>';
            }
        })
        ->rawColumns([__('hoten'),__('hinhanh'),__('giatien'),__('ngay'),__('hanhdong')])
        ->make(true);
    }

    public function ajax_recharge(Request $request)
    {
        try {
            $idNapTien=$request->txt_id_naptien;
            $naptien=NapTien::find($idNapTien);
            $sotien=$naptien->SoTienNap;
            $idUser=$naptien->idUser;
            $user=User::find($idUser);
            $sotienUser=$user->SoTien;
            $tongSoTienUser=$sotien+$sotienUser;
            $user->SoTien=$tongSoTienUser;
            $naptien->Status=1;
            $user->save();
            $naptien->save();
            // Send mail
            $sumMoney=$user->SoTien;
            $emailUser=$user->email;
            $now=Carbon::now('Asia/Ho_Chi_Minh');
            $title_mail="NẠP TIỀN THÀNH CÔNG".' '.$now;
            $page_notice="Bạn đã nạp thành công".' '.number_format($sotien).'VNĐ vào tài khoản có email: '.$emailUser.'. Tổng số tiền trong tài khoản là: '.number_format($sumMoney).'VNĐ';
            $data=array("name"=>$title_mail,"body"=>$page_notice,"email"=>$emailUser);
            Mail::send('frontend.notice_mail.notice_recharge',['data'=>$data],function($message) use($title_mail,$data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });

            return response()->json([
                'success'=>'success',
            ],200);

        } catch (\Throwable $e) {
            return response()->json([
                'err'=>'err',
            ],400);
        }  
    }

    public function del_recharge(Request $request)
    {
        try {
            $idNapTien=$request->txt_id_nap_tien;
            $naptien=NapTien::find($idNapTien);
            $naptien->delete();
            return response()->json([
                'success'=>'success',
            ],200); 

        } catch (\Throwable $e) {
            return response()->json([
                'err'=>'err',
            ],400);
        }
    }
}
