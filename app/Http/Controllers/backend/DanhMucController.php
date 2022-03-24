<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\DanhMuc;
use App\User;
use Auth;
use App\models\ChiTietDanhMuc;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class DanhMucController extends Controller
{
    //List danh sach danh muc
    public function ListCategory(){
     
        $danhmuc=DanhMuc::where('HienThiDM','=',null)
        ->orderBy('idDanhMuc','desc')
        ->get();
        return Datatables::of($danhmuc)
        ->addIndexColumn()
        ->addColumn(__('edit_danh_muc'),function($danhmuc){
            if(Auth::user()->hasRole(['Admin'])){
                return '<a href="../admin/edit-category/id='.$danhmuc->idDanhMuc.'" class="fa fa-edit"></a>
                <a id="'.$danhmuc->idDanhMuc.'" onclick=btn_del_dm('.$danhmuc->idDanhMuc.') class="fas fa-trash-alt"></a>';
            }
            else{
                return '<a href="../admin/edit-category/id='.$danhmuc->idDanhMuc.'" class="fa fa-edit"></a>';

            }
        })
        
        ->addColumn(__('ViewMainMenu'),function($danhmuc){
            if($danhmuc->HienThiTrenMainMenu=="1"){
                return '<input type="checkbox" checked disabled />';
            }
            else{
                return '<input type="checkbox" disabled />';
            }
        })
        ->addColumn(__('ViewHeadMenu'),function($danhmuc){
            if($danhmuc->HienThiTrenHeadMenu=="1"){
                return '<input type="checkbox" checked disabled />';
            }
            else{
                return '<input type="checkbox" disabled />';
            }
        })
        ->rawColumns([__('edit_danh_muc'),__('ViewMainMenu'),__('ViewHeadMenu')])
        ->make(true);
}


    function GetCategorys(){
        $data['category']=DanhMuc::all()->toArray();
        return view('backend.danh-muc.add_danh_muc',$data);
    }



//Them moi danh muc
   public function AddCategory(Request $request){

        $messages=[
            'required'=>'Không được để trống!',
            'txt_vitritrenmainmenu.numeric'=>'Dữ liệu nhập phải là số!',
            'txt_vitritrenheadmenu.numeric'=>'Dữ liệu nhập phải là số!',
            'txt_vitritrenmainmenu.min'=>'Không được số âm!',
            'txt_vitritrenheadmenu.min'=>'Không được số âm!',

            
        ];
        $validate=Validator::make(
            $request->all(),
            [
                'txt_tieude'=>'required',
                'txt_vitritrenmainmenu'=>'numeric|min:0',
                'txt_vitritrenheadmenu'=>'numeric|min:0',
            ],
            $messages
        );
        if($validate->fails()){
           $response= $validate->messages();
        }
        else{
            $danhmuc=new DanhMuc;
                   
            $danhmuc->TieuDeDanhMuc=$request->txt_tieude;
            $danhmuc->idDanhMucCha=$request->txt_danhmuccha;
            $danhmuc->TieuDeDanhMuc_Slug=$request->tieude_slug;
            $danhmuc->MoTaDanhMuc=$request->txt_mota;
            $danhmuc->NoiDungDanhMuc=$request->txt_noidung;
            if($request->txt_hienthitrenmaninmenu=="on"){
                $danhmuc->HienThiTrenMainMenu=1;
            }
            else{
                $danhmuc->HienThiTrenMainMenu=0;
            }
            if($request->txt_hienthitrenheadMenu=="on"){
                $danhmuc->HienThiTrenHeadMenu=1;
            }
            else{
                $danhmuc->HienThiTrenHeadMenu=0;
            }
           
            $danhmuc->ViTriTrenMainMenu=$request->txt_vitritrenmainmenu;
            
           
            $danhmuc->ViTriTrenHeadMenu=$request->txt_vitritrenheadmenu;
            
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $danhmuc->ThoiGianTaoDM=$dateTime;
            $danhmuc->save();
            $response=['success'=>'Them moi thanh cong'];
           
        }
        return response()->json([
            $response,
            // $danhmuc,
        ],200);
      
    }
    //Hien thi thong tin can chinh sua
    function EditCategory($idDanhMuc){
        $data['cate']=DanhMuc::find($idDanhMuc);
        $data['category']=DanhMuc::all()->toArray();

        return view('backend.danh-muc.sua_danh_muc',$data);
    }
    // Lay danh muc theo id
    public function GetIDDanhMuc(Request $r){
        $idDanhMuc=$r->all();
        $danhmuc=DanhMuc::where('idDanhMuc','=',$idDanhMuc)->first();
        return response()->json([
            'danhmuc'=>$danhmuc,
        ],200);
    }

    //Cap nhat danh muc
    public function EditDanhMuc(Request $request){

        $messages=[
            'required'=>'Không được để trống!',
            'txt_vitritrenmainmenu.numeric'=>'Dữ liệu nhập phải là số!',
            'txt_vitritrenheadmenu.numeric'=>'Dữ liệu nhập phải là số!',
            'txt_vitritrenmainmenu.min'=>'Không được số âm!',
            'txt_vitritrenheadmenu.min'=>'Không được số âm!',
 
        ];
        $validate=Validator::make(
            $request->all(),
            [
                'txt_tieude'=>'required|min:5',
                'txt_vitritrenmainmenu'=>'numeric|min:0',
                'txt_vitritrenheadmenu'=>'numeric|min:0',
            ],
            $messages
        );
        if($validate->fails()){
           $response= $validate->messages();
        }
        else{
            $idDanhMuc=$request->txt_id_dm;
            $danhmuc=DanhMuc::find($idDanhMuc);
            $danhmuc->TieuDeDanhMuc=$request->txt_tieude;
            $danhmuc->TieuDeDanhMuc_Slug=$request->tieude_slug;
            $danhmuc->idDanhMucCha=$request->txt_danhmuccha;
            if($request->txt_hienthitrenmainnmenu=="on"){
                $danhmuc->HienThiTrenMainMenu=1;
            }
            else{
                $danhmuc->HienThiTrenMainMenu=0;
            }
            if($request->txt_hienthitrenheadmenu=="on"){
                $danhmuc->HienThiTrenHeadMenu=1;
            }
            else{
                $danhmuc->HienThiTrenHeadMenu=0;
            }
           
            $danhmuc->ViTriTrenMainMenu=$request->txt_vitritrenmainmenu;
            
           
            $danhmuc->ViTriTrenHeadMenu=$request->txt_vitritrenheadmenu;
            
            
            $danhmuc->MoTaDanhMuc=$request->txt_mota;
            $danhmuc->NoiDungDanhMuc=$request->txt_noidung;
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $danhmuc->ThoiGianSuaDM=$dateTime;
            $danhmuc->save();

            $response=['success'=>'Chỉnh sửa thành công!'];
            
        }
        return response()->json([
            $response,
            // $danhmuc,
        ],200);

    }

    //Delete Danh muc
    public function DeleteCategory(Request $r){
        $danhmuc=new DanhMuc;
        
        $idDanhMuc=$r->txt_id_dm;
        $del_cat=ChiTietDanhMuc::where('id_DanhMuc','=',$idDanhMuc)->get();
        foreach($del_cat as $row){
            $chitietDM=ChiTietDanhMuc::find($row->idTinTucDanhMuc);
            $chitietDM->delete();
        }
        $danhmuc=DanhMuc::find($idDanhMuc);
        $danhmuc->delete();

        return response()->json([
            'message'=>'Xoa thanh cong',
        ]);


    }
}
