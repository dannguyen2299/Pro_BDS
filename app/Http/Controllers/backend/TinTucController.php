<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\DanhMuc;
use App\models\TinTuc;
use App\models\ChiTietDanhMuc;
use Carbon\Carbon;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class TinTucController extends Controller
{
    //Danh sach tin tuc
    public function ListTinTuc()
    {
        $tintuc=TinTuc::orderBy('idTinTuc','DESC')->get();

        return Datatables::of($tintuc)
        ->addIndexColumn()
        ->addColumn(__('edit_tin_tuc'),function($tintuc){
            if(Auth::user()->hasRole(['Admin'])){
                return '<a href="../admin/edit-news/id='.$tintuc->idTinTuc.'" class="fa fa-edit"></a>
                <a id="'.$tintuc->idTinTuc.'" onclick=btn_del_new('.$tintuc->idTinTuc.') class="fas fa-trash-alt"></a>';
            }
            else{
                return '<a href="../admin/edit-news/id='.$tintuc->idTinTuc.'" class="fa fa-edit"></a>';

            }
        })
        ->addColumn(__('danhmuc'),function($tintuc){
            $tintucs=TinTuc::get();
            $danhmuc=array();

            foreach($tintucs as $tintucss){
                $danhmuc_tintuc=ChiTietDanhMuc::join('tin_tuc','tin_tuc.idTinTuc','=','chi_tiet_danh_muc.id_TinTuc')
                                ->join('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_danh_muc.id_DanhMuc')
                                ->where('chi_tiet_danh_muc.id_TinTuc',$tintucss->idTinTuc)
                                ->get();
                $str_cate='';
                foreach($danhmuc_tintuc as $cate){
                    $str_cate=$str_cate.' <span class="badge bg-primary">'.$cate->TieuDeDanhMuc. '</span>';
                }
                $danhmuc[$tintucss->idTinTuc]=$str_cate;
            }


            return $danhmuc[$tintuc->idTinTuc];
        })
        ->addColumn(__('hinh_anh'),function($tintuc){
            return '<img src="dist/img/'.$tintuc->AnhDaiDien.'" alt="'.$tintuc->AnhDaiDien.'" style="width:100%;">';
        })
        ->rawColumns([__('edit_tin_tuc'),__('hinh_anh'),__('danhmuc')])
        ->make(true);

    }
    // END

    // View page them tin tuc
    function AddTinTuc(){
        $data['category']=DanhMuc::all()->toArray();
        return view('backend.tin-tuc.add_tin_tuc',$data);
    }
    // END

    // Lay danh muc
    public function GetCate(){
        $danhmuc=DanhMuc::all()->toArray();

            return response()->json([
            'danhmuc'=>$danhmuc,
        ],200);

    }
    // END

    // Them tin tuc
    public function AddNews(Request $request){
        $messages=[
            'required'=>'Không được để trống!',
            'select_file.mimes'=>'File ảnh phải đúng định dạng (jpg, jpeg, png)',
        ];

        $validate=Validator::make(
            $request->all(),
            [
                'txt_tieude'=>'required',
                'txt_mota'=>'required',
                'txt_danhmuc'=>'required',
                'txt_noidung'=>'required',
                'select_file'=>'mimes:jpg,jpeg,png',
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
        }
        else{
            $tintuc=new TinTuc;

            $tintuc->TieuDeTinTuc=$request->txt_tieude;
            $tintuc->MoTaTinTuc=$request->txt_mota;
            $tintuc->TieuDeTinTuc_Slug=$request->txt_tieude_slug;
            if($request->hasFile('select_file')){
                $image=$request->file('select_file');
                $new_name=$request->txt_tieude_slug . '-' . rand(1,10000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('backend/dist/img'),$new_name);
                $tintuc->AnhDaiDien=$new_name;
            }
            else{
                $tintuc->AnhDaiDien='no-img.jpg';
            }

            $tintuc->NoiDungTinTuc=$request->txt_noidung;
            $danhmuc=$request->txt_danhmuc;
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $tintuc->ThoiGianTaoTT=$dateTime;
            $tintuc->save();

            $idTinTuc=$tintuc->idTinTuc;
            for($i=0;$i<count($danhmuc);$i++)
            {
                $chiTietDanhMuc=new ChiTietDanhMuc;
                $chiTietDanhMuc->id_TinTuc=$idTinTuc;
                $chiTietDanhMuc->id_DanhMuc=$danhmuc[$i];

                $chiTietDanhMuc->save();

            }

            $response=['success'=>'Thêm mới tin tức thành công!'];
         }


        return response()->json([
         $response,

    ],200);

    }
    // END

    // View thong tin can chinh sua
    function ViewEdit($idTinTuc){
        $data['category']=DanhMuc::all()->toArray();
        $data['select_category']=ChiTietDanhMuc::join('tin_tuc','tin_tuc.idTinTuc','=','chi_tiet_danh_muc.id_TinTuc')
        ->join('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_danh_muc.id_DanhMuc')
        ->where('chi_tiet_danh_muc.id_TinTuc',$idTinTuc)
        ->get();
        $data['tintuc']=TinTuc::find($idTinTuc);

        return view('backend.tin-tuc.edit_tin_tuc',$data);
    }



    public function GetIDNews(Request $r){
        $idNew=$r->all();
        $tintuc=TinTuc::where('idTinTuc','=',$idNew)->first();
        return response()->json([
            'tintuc'=>$tintuc,
        ],200);
    }
    // END

    // Chinh sua tin tuc
    public function EditNews(Request $request){
        $messages=[
            'required'=>'Không được để trống!',
            'select_file.mimes'=>'File ảnh phải đúng định dạng (jpg, jpeg, png)',
        ];

        $validate=Validator::make(
            $request->all(),
            [
                'txt_tieude'=>'required',
                'txt_mota'=>'required',
                'txt_danhmuc'=>'required',
                'txt_noidung'=>'required',
                'select_file'=>'mimes:jpg,jpeg,png',
            ],
            $messages
        );

        if($validate->fails()){
            $response=$validate->messages();
        }
        else
        {
            $idTinTuc=$request->txt_id_new;
            $tintuc=TinTuc::find($idTinTuc);
            $tintuc->TieuDeTinTuc=$request->txt_tieude;
            $tintuc->MoTaTinTuc=$request->txt_mota;
            $tintuc->TieuDeTinTuc_Slug=$request->txt_tieude_slug;

            // Chinh sua anh
            if($request->hasFile('select_file'))
            {
                if($tintuc->AnhDaiDien!='no-img.jpg')
                {
                    unlink('backend/dist/img/'.$tintuc->AnhDaiDien);
                }

                $image=$request->file('select_file');
                $new_name=$request->txt_tieude_slug . '-' . rand(1,10000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('backend/dist/img'),$new_name);
                $tintuc->AnhDaiDien=$new_name;
            }
            // END

            $tintuc->NoiDungTinTuc=$request->txt_noidung;
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $tintuc->ThoiGianSuaTT=$dateTime;
            $tintuc->save();

            // Chinh sua danh muc
            if($request->txt_danhmuc != null)
            {
                $cates=array();
                $cate=array();
                $size=count($request->txt_danhmuc);
                for($i=0;$i<$size;$i++){
                    $cate['id_TinTuc']=$idTinTuc;
                    $cate['id_DanhMuc']=$request->txt_danhmuc[$i];
                    $cates[]=$cate;
                }

                // $cate_new=ChiTietDanhMuc::find($idTinTuc);
                // $cate_new->delete();
                //$new_cate=new ChiTietDanhMuc;
                DB::table('chi_tiet_danh_muc')->where('id_TinTuc',$idTinTuc)->delete();
                DB::table('chi_tiet_danh_muc')->insert($cates);
            }
            else
            {
                DB::table('chi_tiet_danh_muc')->where('id_TinTuc',$idTinTuc)->delete();
            }
            // END

            $response=['success'=>'Chỉnh sửa thành công!'];
        }
        return response()->json([
            $response,
        ],200);

    }
    // END

    // Delete Tin tuc
    public function DeleteNews(Request $request)
    {

        $idNew=$request->txt_id_new;
        $del_new=ChiTietDanhMuc::where('id_TinTuc','=',$idNew)->get();
        foreach($del_new as $row){
            $chitietDM=ChiTietDanhMuc::find($row->idTinTucDanhMuc);
            $chitietDM->delete();
        }
        $tintuc=TinTuc::find($idNew);
        $tintuc->delete();

        return response()->json([
            'message'=>'Xóa thành công',
        ],200);
    }
    // END

}
