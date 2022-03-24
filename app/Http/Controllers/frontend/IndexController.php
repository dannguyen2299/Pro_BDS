<?php

namespace App\Http\Controllers\frontend;
use App\models\DanhMuc;
use App\models\BatDongSan;
use App\models\TinTuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ChiTietBatDongSan;
use App\models\Provinces;
use Carbon\Carbon;
use DB;
class IndexController extends Controller
{
    //

    function Index(){
        $data['category']=DanhMuc::where('TieuDeDanhMuc','<>','Tin tức')->get()->toArray();
        $city=Provinces::orderBy('id','ASC')->get();
        $category=DanhMuc::where('idDanhMucCha','=','-1')->where('TieuDeDanhMuc','<>','Tin tức')->orderBy('idDanhMuc','asc')->get();

        return view('frontend.index',$data)->with('city',$city)->with('category',$category);
    }

    public function danh_muc(){
         $danhmuccha=DanhMuc::query()->fromSub(function($query){
             $query->from('danh_muc')->where('idDanhMucCha','=',-1);
         },'danhmuc')->where('HienThiTrenMainMenu','=','1')->orderBy('ViTriTrenMainMenu','ASC')->get();

         $danhmuccon=DanhMuc::query()->fromSub(function($query){
            $query->from('danh_muc')->where('idDanhMucCha','<>','-1');
        },'danhmucs')->where('HienThiTrenHeadMenu','=','1')->orderBy('ViTriTrenHeadMenu','ASC')->get();

        $arr=array();
        foreach($danhmuccha as $row){
            $idDanhMuc=$row->idDanhMuc;
            $count=DanhMuc::query()->fromSub(function($query) use($idDanhMuc){
                $query->from('danh_muc')->where('idDanhMucCha','=',$idDanhMuc);
            },'danhmucs')->count();

            $arr[$idDanhMuc]=$count;
        }
     
        return response()->json([
            'danhmuccha'=>$danhmuccha,
            'danhmuccon'=>$danhmuccon,
            // 'idDanhmuc'=>$idDanhMuc,
            'arr'=>$arr,
        ],200);
    }

    public function featured_estate(){
        $batdongsan=BatDongSan::query()->fromSub(function($query){
            $query->from('bat_dong_san')->join('provinces','provinces.id','=','bat_dong_san.id_TinhThanh')

                                        ->where('HinhThuc',2);
        },'batdongsan')->where('HienThiBDS',1)->orderBy('idBDS','ASC')->paginate(8);

        $tintuc=TinTuc::orderBy('idTinTuc','DESC')->paginate(8);

        //$count=BatDongSan::groupBy('id_TinhThanh')->count();
        $count=BatDongSan::select('id_TinhThanh',DB::raw("count(*) as BDS "))
                    ->groupBy('id_TinhThanh')->orderBy('BDS','DESC')->paginate(8);

        $arr=array();
         foreach($count as $row){
             $id=$row->id_TinhThanh;
             $name_provice=Provinces::select('name')->join('bat_dong_san','provinces.id','=','bat_dong_san.id_TinhThanh')->where('id',$id)->groupBy('name')->get();
             $arr[$id]=$name_provice;
         }

        return response()->json([
            'batdongsan'=>$batdongsan,
            'tintuc'=>$tintuc,
            'count'=>$count,
            'array'=>$arr,
        ],200);
    }

    public function GetCategorys($slug_category){

        $category=DanhMuc::where('TieuDeDanhMuc_Slug',$slug_category)->first()->toarray();
        
        foreach($category as $idDanhMuc){
            
            $batdongsan=ChiTietBatDongSan::query()->fromSub(function($query) use($idDanhMuc){
                $query->from('chi_tiet_bat_dong_san')->join('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_bat_dong_san.id_DanhMuc')
                                                    ->join('bat_dong_san','bat_dong_san.idBDS','=','chi_tiet_bat_dong_san.id_BDS')
                                                    ->leftjoin('provinces','provinces.id','=','bat_dong_san.id_TinhThanh')
                                                    ->where('chi_tiet_bat_dong_san.id_DanhMuc',$idDanhMuc)
                                                    ->where('bat_dong_san.HienThiBDS',1);
                                                    
            },'batdongsan')->orderBy('id_LoaiTin','DESC')->orderBy('idBDS','DESC')->paginate(16);
         
            $category=DanhMuc::where('idDanhMuc',$idDanhMuc)->first();
            return view('frontend.listing')->with('batdongsan',$batdongsan)->with('category',$category);
           
        }
       
    }

    public function tin_tuc(){

        return view('frontend.blog');
    }
    
    public function Tintuc(){
        $tintuc=TinTuc::orderBy('idTinTuc','DESC')->paginate(8);

        return response()->json([
            'tintuc'=>$tintuc,
        ],200);
    }
  
}
