<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BatDongSan;
use App\BatDongSanFilter;
use App\models\ChiTietBatDongSan;
class FilterController extends Controller
{
    //
    public function filter_estate(BatDongSanFilter $bdsFilter){
        $batdongsan=BatDongSan::query()->fromSub(function($query){
            $query->from('bat_dong_san')->join('provinces','provinces.id','=','bat_dong_san.id_TinhThanh');
                                      
        },'batdongsan')->where('HienThiBDS',1)->orderBy('id_LoaiTin','desc')->orderBy('idBDS','ASC')->filter($bdsFilter)->paginate(8);
       

        return view('frontend.search')->with('batdongsan',$batdongsan);
    }
}
