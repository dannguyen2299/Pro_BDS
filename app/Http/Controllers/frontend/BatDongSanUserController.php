<?php

namespace App\Http\Controllers\frontend;
use App\models\BatDongSan;
use App\models\Provinces;
use App\models\Districts;
use App\models\Wards;
use App\models\DanhMuc;
use App\models\HinhAnh;
use App\models\ChiTietBatDongSan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class BatDongSanUserController extends Controller
{
    public function ListEstateUser(){

        return view('frontend.danhsachtindang');
    }

    public function List_Estate_User(){
        $idUser=Auth::user()->id;
        $bds_user=BatDongSan::query()->fromSub(function($query) use($idUser){
            $query->from('bat_dong_san')->join('loai_tin','loai_tin.idLoaiTin','=','bat_dong_san.id_LoaiTin')
                                ->where('id_user',$idUser);
        },'batdongsan')->where('HienThiBDS','<>',4)->orderBy('idBDS','desc')->get();

        // $bds_user=BatDongSan::join('loai_tin','loai_tin.idLoaiTin','=','bat_dong_san.id_LoaiTin')
        //                     ->where('id_User',$idUser)
        //                     ->where('HienThiBDS','<>',4)
                           
                            
        //                     ->orderBy('idBDS','desc')->get();
        
        return Datatables::of($bds_user)
        ->addIndexColumn()
        ->addColumn(__('hinhanh'),function($bds_user){
            return '<img src="../image/avatar/estate/'.$bds_user->AnhDaiDien.'" alt="'.$bds_user->AnhDaiDien.'" style="width:100%;">';
        })

        ->addColumn(__('tinhtrang'),function($bds_user){
            if($bds_user->HienThiBDS==1){
                return '<span class="badge bg-primary">Đã duyệt</span>';
            }
            else if($bds_user->HienThiBDS==0 || $bds_user->HienThiBDS==3){
                return '<span>Đang chờ duyệt...</span>';    
            }
            else{
                return '<span>Đã hêt hạn</span>';
            }
        })
        ->addColumn(__('hanhdong'),function($bds_user){
            if($bds_user->HienThiBDS==1){
                $timeBDS=new Carbon($bds_user->ThoiGianTaoBDS);
                $dtFormat=$timeBDS->year . $timeBDS->month . $timeBDS->day;
                return '<a href="../chinh-sua-bat-dong-san/id='.$bds_user->idBDS.'" class="fa fa-edit" title="Sửa"></a> |
                        <a onclick=btn_del_bds_user('.$bds_user->idBDS.') style="color:red;" title="Xóa" class="fa fa-trash"></a> |
                        <a style="color: blue; text-decoration: underline" href="../'.$dtFormat.'/'.$bds_user->idBDS.'/'.$bds_user->TieuDeBDS_Slug.'">Xem tin đăng</a>';
            }
            else if($bds_user->HienThiBDS==0 || $bds_user->HienThiBDS==3){
                return '<a href="../chinh-sua-bat-dong-san/id='.$bds_user->idBDS.'" class="fa fa-edit" title="Sửa"></a> |
                        <a onclick=btn_del_bds_user('.$bds_user->idBDS.') style="color:red;" title="Xóa" class="fa fa-trash"></a>';
                         
            }
            else{
                return '<a href="../repost/id='.$bds_user->idBDS.'">Đăng lại</a> |
                        <a onclick=btn_del_bds_user('.$bds_user->idBDS.') style="color:red;" title="Xóa" class="fa fa-trash"></a>';
            }
                   
        })
        ->addColumn(__('luotxem'),function($bds_user){
            if($bds_user->ViewBDS==null){
                return '<span class="fa fa-eye"><span> 0';
            }
            else{
                return '<span class="fa fa-eye"><span> '.$bds_user->ViewBDS;
            }
            
        })
        ->rawColumns([__('hinhanh'),__('hanhdong'),__('tinhtrang'),__('luotxem')])
        ->make(true);
    }

    public function EditBDS_User($idBDS){
        $bds=BatDongSan::where('idBDS',$idBDS)->first();
        if($bds->id_User==Auth::user()->id){
            $batdongsan=BatDongSan::join('districts','districts.id','=','bat_dong_san.id_QuanHuyen')
            ->join('provinces','provinces.id','=','bat_dong_san.id_TinhThanh')
            ->join('wards','wards.id','=','bat_dong_san.id_XaPhuong')
            ->join('chi_tiet_bat_dong_san','chi_tiet_bat_dong_san.id_BDS','=','bat_dong_san.idBDS')
            ->leftjoin('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_bat_dong_san.id_DanhMuc')
            ->join('loai_tin','loai_tin.idLoaiTin','=','bat_dong_san.id_LoaiTin')
            ->join('user','user.id','=','bat_dong_san.id_User')
            ->where('idBDS',$idBDS)
            ->select('*','districts.name AS dic','provinces.name AS pro','wards.name AS war','danh_muc.TieuDeDanhMuc AS TieuDeDM','bat_dong_san.HienThiBDS AS Show')
            ->first();
            $city=Provinces::orderBy('id','ASC')->get();
            $district=Districts::orderBy('id','ASC')->get();
            $ward=Wards::orderBy('id','ASC')->get();
            $hinhthuc=DanhMuc::where('danh_muc.idDanhMucCha','-1')->orderBy('idDanhMuc','asc')->get();
            $loai=DanhMuc::where('danh_muc.idDanhMucCha','<>','-1')->orderBy('idDanhMuc','asc')->get();
                                    
            return view('frontend.edit_bds_user')->with('city',$city)->with('bds',$batdongsan)->with('district',$district)->with('ward',$ward)->with('hinhthuc',$hinhthuc)->with('loai',$loai);
        }
        else{
            return view('frontend.404');
        }
    }

    public function GetIDBDS_User(Request $request){
        $idBDS=$request->all();
        $bds=BatDongSan::where('idBDS',$idBDS)->first();
        if($bds->id_User==Auth::user()->id)
        {
            $batdongsan=BatDongSan::join('districts','districts.id','=','bat_dong_san.id_QuanHuyen')
                                ->join('provinces','provinces.id','=','bat_dong_san.id_TinhThanh')
                                ->join('wards','wards.id','=','bat_dong_san.id_XaPhuong')
                                ->join('chi_tiet_bat_dong_san','chi_tiet_bat_dong_san.id_BDS','=','bat_dong_san.idBDS')
                                ->leftjoin('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_bat_dong_san.id_DanhMuc')
                                ->join('loai_tin','loai_tin.idLoaiTin','=','bat_dong_san.id_LoaiTin')
                                ->join('user','user.id','=','bat_dong_san.id_User')
                                ->where('idBDS',$idBDS)
                                ->select('*','districts.name AS dic','provinces.name AS pro','wards.name AS war','danh_muc.TieuDeDanhMuc AS TieuDeDM','bat_dong_san.HienThiBDS AS Show')
                                ->first();
            $hinhanh=HinhAnh::where('id_BDS',$idBDS)->get();
            return response()->json([
                'bds'=>$batdongsan,
                'hinhanh'=>$hinhanh,
            ]);
        }
        else{
            return response()->json([
                'err'=>"Đã có lỗi xảy ra!",
            ]);
        }
    }

    public function EditEstate_User(Request $request)
    {
        $messages=[
            'required'=>'Không được để trống!',
            'txt_tieude.max'=>'Tiêu đề tối đa 100 ký tự',
            'txt_tieude.min'=>'Tiêu đề tối thiểu 6 ký tự',
            'txt_dientich.numeric'=>'Diện tích phải là chữ số',
            'txt_dientich.min'=>'Diện tích phải lớn hơn 0',
            'select_file.mimes'=>'File ảnh phải đúng định dạng (jpg, jpeg, png)',
            'txt_mota.max'=>'Mô tả tối đa 3000 ký tự',
            'txt_mattien.numeric'=>'Mặt tiền phải là chữ số',
            'txt_mattien.min'=>'Mặt tiền phải lớn hơn 0',
            'txt_duongvao.numeric'=>'Đường vào phải là chữ số',
            'txt_duongvao.min'=>'Đường vào phải lớn hơn 0',
            'txt_sotang.numeric'=>'Số tầng phải là chữ số',
            'txt_sotang.min'=>'Số tầng phải lớn hơn 0',
            'txt_sophongngu.numeric'=>'Số phòng ngủ phải là chữ số',
            'txt_sophongngu.min'=>'Số phòng ngủ phải lớn hơn 0',
            'txt_sotoilet.numeric'=>'Số Toilet phải là chữ số',
            'txt_sotoilet.min'=>'Số Toilet phải lớn hơn 0',
        ];

        $validate=Validator::make(
            $request->all(),
            [
                'txt_tieude'=>'required|min:6|max:100',
                'txt_hinhthuc'=>'required',
                'txt_loaibds'=>'required',
                'txt_dientich'=>'numeric|min:0',
                'txt_diachi'=>'required',
                'select_file'=>'mimes:jpg,jpeg,png',
                'txt_mota'=>'required|max:3000',
                'txt_mattien'=>'numeric|min:0',
                'txt_duongvao'=>'numeric|min:0',
                'txt_sotang'=>'numeric|min:0',
                'txt_sophongngu'=>'numeric|min:0',
                'txt_sotoilet'=>'numeric|min:0',
                'txt_tenlienhe'=>'required',
                'txt_diachilienhe'=>'required',
                'txt_dienthoailienhe'=>'required',
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
            return response()->json([$response]);
        }
        else{

            $txt_id_bds=$request->txt_id_bds;
            $bds=BatDongSan::where('idBDS',$txt_id_bds)->first();
            
            if($bds->id_User==Auth::user()->id){
                $batdongsan=BatDongSan::find($txt_id_bds);
                $batdongsan->TieuDeBDS=$request->txt_tieude;
                $batdongsan->TieuDeBDS_Slug=$request->tieude_slug;
                $batdongsan->HinhThuc=$request->txt_hinhthuc;
                $batdongsan->LoaiBDS=$request->txt_loaibds;
                $batdongsan->id_TinhThanh=$request->txt_tinhthanh;
                $batdongsan->id_QuanHuyen=$request->txt_quanhuyen;
                $batdongsan->id_XaPhuong=$request->txt_phuongxa;
                $batdongsan->DienTich=$request->txt_dientich;
                $batdongsan->GiaTienBDS=$request->txt_giaBDS;
                $batdongsan->GiaTienBDS_JS=$request->txt_showMoney;
                $batdongsan->DonVi=$request->txt_donvi;
                $batdongsan->DiaChiBDS=$request->txt_diachi;
                $batdongsan->MoTaBDS=$request->txt_mota;
                $batdongsan->NoiDungBDS=$request->txt_noidung;
                $batdongsan->MatTien=$request->txt_mattien;
                $batdongsan->DuongVao=$request->txt_duongvao;
                $batdongsan->HuongNha=$request->txt_huongnha;
                $batdongsan->HuongBanCong=$request->txt_huongbancong;
                $batdongsan->SoTang=$request->txt_sotang;
                $batdongsan->SoPhongNgu=$request->txt_sophongngu;
                $batdongsan->SoToilet=$request->txt_sotoilet;
                $batdongsan->NoiThat=$request->txt_noithat;
                $batdongsan->ThongTinPhapLy=$request->txt_phaply;
                $batdongsan->TenLienHe=$request->txt_tenlienhe;
                $batdongsan->DiaChiLienHe=$request->txt_diachilienhe;
                $batdongsan->DienThoai=$request->txt_dienthoailienhe;
                $batdongsan->emailUser=$request->txt_emaillienhe;
                // Chinh sua anh dai dien
                if($request->hasFile('select_file')){
                    if($batdongsan->AnhDaiDien!='no-img.jpg')
                    {
                        unlink('image/avatar/estate/'.$batdongsan->AnhDaiDien);
                    }
                    
                    $image=$request->file('select_file');
                    $new_name=$request->tieude_slug . '-' . rand(1,10000) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('image/avatar/estate'),$new_name);
                    $batdongsan->AnhDaiDien=$new_name;
                }
                $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
                $batdongsan->ThoiGianSuaBDS=$dateTime;
                $batdongsan->save();

                $hinhThucBDS=$batdongsan->HinhThuc;
                $loaiBDS=$batdongsan->LoaiBDS;
                $chitietBDS=ChiTietBatDongSan::where('id_BDS',$txt_id_bds)->get();
                foreach($chitietBDS as $row){
                    $del_chitietBDS=ChiTietBatDongSan::find($row->idChiTietBDS);
                    $del_chitietBDS->delete();
                }
                $chiTietbds=new ChiTietBatDongSan();
                $chiTietbds->id_DanhMuc=$hinhThucBDS;
                $chiTietbds->id_BDS=$txt_id_bds;
                $chiTietbds->save();

                $chiTietbds=new ChiTietBatDongSan();
                $chiTietbds->id_DanhMuc=$loaiBDS;
                $chiTietbds->id_BDS=$txt_id_bds;
                $chiTietbds->save();
                $response=[
                            'success'=>'success',
                            'txt_id_bds'=>$txt_id_bds,
                          ];
                    // return response()->json([
                    //     $response,
                    //     'txt_id_bds'=>$txt_id_bds, 
                    // ],200);
            } 
            else{
                $response=['err'=>'err'];
            }  
             return response()->json([
            $response,
        ]);
        }
    }

    public function Delete_BDS_User(Request $request){
        $id_BDS=$request->id_BDS;
        $bds=BatDongSan::where('idBDS',$id_BDS)->first();

        if($bds->id_User==Auth::user()->id){
            $hinhanh=HinhAnh::where('id_BDS',$id_BDS)->get();
            $file_path=public_path('image/estates/');
            foreach($hinhanh as $image){
                $img=HinhAnh::find($image->idHinhAnh);
                $img->delete();
                $path=$file_path.'/'.$image->TenAnh;
                if(file_exists($path)){
                    unlink($path);
                }
            }
            $chitietBDS=ChiTietBatDongSan::where('id_BDS',$id_BDS)->get();
            foreach($chitietBDS as $row){
                $chitiet=ChiTietBatDongSan::find($row->idChiTietBDS);
                $chitiet->delete();
            }
            $batdongsan=BatDongSan::find($id_BDS);
            $batdongsan->delete();

            return response()->json([
                'message'=>"Xóa thành công!",
            ],200);
        }
        else{
            return response()->json([
                'err'=>"Thao tác sai, vui lòng thực hiện lại",
            ],400);
        }
    }
}
