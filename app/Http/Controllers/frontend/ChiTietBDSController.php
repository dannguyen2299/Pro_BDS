<?php

namespace App\Http\Controllers\frontend;
use App\models\BatDongSan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\HinhAnh;

class ChiTietBDSController extends Controller
{
    //
    public function view_estate_detail($date_time,$id_bds,$slug_estate)
    {
        try {
            $batdongsan=BatDongSan::where('idBDS',$id_bds)->where('TieuDeBDS_Slug',$slug_estate)->first();
            Carbon::setLocale('vi');
            $dateTime=Carbon::create($batdongsan->ThoiGianTaoBDS,'Asia/Ho_Chi_Minh');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $days=$dateTime->diffForHumans($now);
            $hinhanh=HinhAnh::where('id_BDS',$id_bds)->get();
            // return response()->json([
            //     'bds'=>$batdongsan,
            // ]);
            $viewBDS=BatDongSan::where('idBDS',$id_bds)->first();
            $viewBDS->ViewBDS=$viewBDS->ViewBDS+1;
            $viewBDS->save();
            return view('frontend.property-single')->with('batdongsan',$batdongsan)->with('days',$days)->with('hinhanh',$hinhanh);
        } catch (\Throwable $e) {
            return view('frontend.404');
        }
        
    }
}
