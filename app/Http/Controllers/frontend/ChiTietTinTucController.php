<?php

namespace App\Http\Controllers\frontend;
use App\models\TinTuc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChiTietTinTucController extends Controller
{
    //
    public function view_new_detail($idNew,$slug_new){
        try {
            $tintuc=TinTuc::where('TieuDeTinTuc_Slug',$slug_new)->where('idTinTuc',$idNew)->first();
            Carbon::setLocale('vi');
            $dateTime=Carbon::create($tintuc->ThoiGianTaoTT,'Asia/Ho_Chi_Minh');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $days=$dateTime->diffForHumans($now);
            // update view tin tuc
            $viewNew=TinTuc::where('idTinTuc',$idNew)->first();
            $viewNew->ViewTinTuc=$viewNew->ViewTinTuc+1;
            $viewNew->save();
            return view('frontend.blog-single')->with('tintuc',$tintuc)->with('days',$days);
        } catch (\Throwable $e) {
            return view('frontend.404');
        }
        
    }

    public function new_relate()
    {
        $tintuc=TinTuc::orderBy('idTinTuc','desc')->paginate(6);
        return response()->json([
            'tin_tuc'=>$tintuc,
        ],200);
    }
}
