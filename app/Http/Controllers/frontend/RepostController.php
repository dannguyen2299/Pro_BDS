<?php

namespace App\Http\Controllers\frontend;

use App\models\BatDongSan;
use App\models\Provinces;
use App\models\Districts;
use App\models\Wards;
use App\models\DanhMuc;
use App\models\HinhAnh;
use App\User;
use App\models\ChiTietBatDongSan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepostController extends Controller
{
    public function Edit_repost($idBDS){
        $bds=BatDongSan::where('idBDS',$idBDS)->first();
        if($bds->id_User==Auth::user()->id && $bds->HienThiBDS==2){
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
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $date=$dateTime->toDateString();
            $date_end=$dateTime->addDays(7)->toDateString();                  
            return view('frontend.repost')
                    ->with('city',$city)
                    ->with('bds',$batdongsan)
                    ->with('district',$district)
                    ->with('ward',$ward)
                    ->with('hinhthuc',$hinhthuc)
                    ->with('loai',$loai)
                    ->with('date',$date)
                    ->with('date_end',$date_end);
        }
        else{
            return view('frontend.404');
        }
    }

    public function add_repost(Request $request){
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
            'txt_ngayketthuc.date'=>'Dữ liệu nhập phải đúng định dạng',
            'txt_ngayketthuc.after'=>'Ngày kết thúc lớn hơn ngày bắt đầu',
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
                'txt_ngayketthuc'=>'date|after:txt_ngaybatdau',
            ],
            $messages
        );
        if($validate->fails()){
            $response=$validate->messages();
            return response()->json([$response]);
        }
        else{
            $txt_money=$request->txt_money;
            $user=User::find(Auth::user()->id);
            $money=$user->SoTien;
            $txt_id_bds=$request->id_bds;
            $bds=BatDongSan::where('idBDS',$txt_id_bds)->first();
            if($txt_money<=$money && $bds->id_User==Auth::user()->id){

                $batdongsan=new BatDongSan();
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
                $batdongsan->id_LoaiTin=$request->txt_loaitin;
                $batdongsan->NgayBatDau=$request->txt_ngaybatdau;
                $batdongsan->NgayKetThuc=$request->txt_ngayketthuc;
                $batdongsan->id_User=Auth::id();
    
                if($request->hasFile('select_file'))
                {
                    $image=$request->file('select_file');
                    $new_name=$request->tieude_slug . '-' . rand(1,10000) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('image/avatar/estate/'),$new_name);
                    $batdongsan->AnhDaiDien=$new_name;
                }
                else
                {
                    $batdongsan->AnhDaiDien=$bds->AnhDaiDien;  
                }
                $batdongsan->TongTien=$request->txt_money;
            
                $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
                $batdongsan->ThoiGianTaoBDS=$dateTime;
                $batdongsan->hienThiBDS=3;
                $batdongsan->save();

                $idBDS=$batdongsan->idBDS;

                // Anh
                $hinhThucBDS=$batdongsan->HinhThuc;
                $loaiBDS=$batdongsan->LoaiBDS;
                $chiTietBDS=new ChiTietBatDongSan();
                $chiTietBDS->id_DanhMuc=$hinhThucBDS;
                $chiTietBDS->id_BDS=$batdongsan->idBDS;
                $chiTietBDS->save();
    
                $chiTietBDS=new ChiTietBatDongSan();
                $chiTietBDS->id_DanhMuc=$loaiBDS;
                $chiTietBDS->id_BDS=$batdongsan->idBDS;
                $chiTietBDS->save();
                
                $users=User::find(Auth::user()->id);
                $sotien=$users->SoTien;
                $sotien_update=$sotien-$request->txt_money;
                $users->SoTien=$sotien_update;
                $users->save();

                $bds_old=BatDongSan::find($txt_id_bds);
                $bds_old->HienThiBDS=4;
                $bds_old->save();
                $hinhanh=HinhAnh::where('id_BDS',$txt_id_bds)->get();
                foreach($hinhanh as $row){
                    $image_repost=new HinhAnh();
                    $image_repost->TenAnh=$row->TenAnh;
                    $image_repost->id_BDS=$idBDS;
                    $image_repost->save();
                }
                $response=[
                    'id_bds'=>$idBDS,
                    'success'=>"success",
                ];
            }
            else{
                $response=[
                    'err'=>"err",
                ];
            }
        }
        return response()->json([
            $response, 
        ],200);
    }
}
