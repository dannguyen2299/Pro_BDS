<?php

namespace App\Http\Controllers\backend;
use App\models\BatDongSan;
use App\models\HinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Provinces;
use App\models\Districts;
use App\models\Wards;
use App\models\DanhMuc;
use App\models\ChiTietBatDongSan;
use Carbon\Carbon;
use App\User;
use Auth;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class BatDongSanController extends Controller
{
    //

    function ListBDS(){
        return view('backend.bat-dong-san.list_bds');
    }
    // Hàm lấy danh sách tin bất động sản
    public function Bds_Ajax(){
        $bds=BatDongSan::orderBy('idBDS','desc')->get();
        return Datatables::of($bds)
        ->addIndexColumn()
        ->addColumn(__('hinhanh'),function($bds){
            return '<img src="../image/avatar/estate/'.$bds->AnhDaiDien.'" alt="'.$bds->AnhDaiDien.'" style="width:100%;">';
        })
        ->addColumn(__('hanhdong'),function($bds){
            if(Auth::user()->hasRole(['Admin'])){
                return '
                <a id="'.$bds->idBDS.'" onclick=btn_del_bds('.$bds->idBDS.') class="fas fa-trash-alt" style="color:red"></a>
                <a id="'.$bds->idBDS.'" onclick=btn_detail('.$bds->idBDS.') class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="width:100px;height:35px;font-size:14px">Xem chi tiết</a>';
            }
            else{
                return '<a id="'.$bds->idBDS.'" onclick=btn_detail('.$bds->idBDS.') class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="width:100px;height:35px;font-size:14px">Xem chi tiết</a>';
              }         
                    
        })
        ->addColumn(__('thongtinngay'),function($bds){
            $ngaybatdau=strtotime($bds->NgayBatDau);
            $ngaykethuc=strtotime($bds->NgayKetThuc);
            $datediff=abs($ngaybatdau-$ngaykethuc);
            $numberDate=floor($datediff / (60*60*24));
            $now=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $kcngay=$ngaykethuc-strtotime($now);
            $ngayconlai=floor($kcngay / (60*60*24));
            if($bds->HienThiBDS==1){
                if($ngayconlai>0){
                    return 'Tổng: '.$numberDate. ' ngày. Còn lại: '.$ngayconlai.' ngày.';
                }
                else{
                    return 'Tổng: '.$numberDate. ' ngày. Đã hết hạn.';
                }      
            }
            else if($bds->HienThiBDS==0 || $bds->HienThiBDS==3){
                return 'Tổng: '.$numberDate.' ngày.';
            }
        })
        ->addColumn(__('ngaycapnhat'),function($bds){
            if($bds->ThoiGianSuaBDS!=null){
                Carbon::setLocale('vi');
                $dateTime=Carbon::create($bds->ThoiGianSuaBDS,'Asia/Ho_Chi_Minh');
                $now = Carbon::now('Asia/Ho_Chi_Minh');
                return $bds->ThoiGianSuaBDS.'</br>('.$dateTime->diffForHumans($now).')';
            }
            else{
                return 'Chưa cập nhật';
            }
            
        })
        ->addColumn(__('tinhtrang'),function($bds){
            if($bds->HienThiBDS==1){
                return '<span class="badge bg-primary">Đã duyệt</span>
                <a onclick=btn_remove('.$bds->idBDS.') class="btn btn-danger">Gỡ bài</a>';
            }
            else if($bds->HienThiBDS==0){
                return '<span class="badge bg-gradient-red">Chưa duyệt</span>
                <a onclick=btn_approve('.$bds->idBDS.') class="btn btn-primary">Duyệt bài</a>';
            }
            else if($bds->HienThiBDS==3){
                return '<span class="badge bg-primary">Đăng lại</span>
                <a onclick=btn_approve('.$bds->idBDS.') class="btn btn-primary">Duyệt bài</a>';

            }
            else{
                return '<span class="badge bg-gradient-red">Hết hạn</span>';
            }
        })
        ->rawColumns([__('hinhanh'),__('hanhdong'),__('tinhtrang'),__('ngaycapnhat'),__('thongtinngay')])
        ->make(true);
    }

// Hàm lấy danh sách danh mục
    function PostEstate(){
        $category=DanhMuc::where('idDanhMucCha','=','-1')->orderBy('idDanhMuc','asc')->get();
        $city=Provinces::orderBy('id','ASC')->get();
        $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
        $date=$dateTime->toDateString();
        $date_end=$dateTime->addDays(7)->toDateString();
        return view('backend.bat-dong-san.add-bds')->with(compact('city'))->with(compact('category'))->with(compact('date'))->with(compact('date_end'));
    }
// Hàm lấy danh sách quận huyện/phường xã
    public function select_category(Request $request){
        $data=$request->all();
        if($data['action']){
            $output='';
            if($data['action']=="txt_hinhthuc"){
                $select_category=DanhMuc::where('idDanhMucCha',$data['id_dm'])->get();
                $output.='<option value="0">--Chọn loại BDS--</option>';
                foreach($select_category as $row){
                    $output.='<option value="'.$row->idDanhMuc.'">'.$row->TieuDeDanhMuc.'</option>';
                }
            }
        }
        echo $output;
    }
// Hàm lấy danh sách loại hình thức bđs
    public function Select_Location(Request $request){
        $data=$request->all();
        if($data['action']){
            $output='';
            if($data['action']=="txt_tinhthanh"){
                $select_district=Districts::where('province_id',$data['matp'])->get();
                $output.='<option value="0">---Chọn quận/huyện---</option>';
                foreach($select_district as $district){
                    $output.='<option value="'.$district->id.'">'.$district->name.'</option>';
                }
                
            }
            else{
                $select_ward=Wards::where('district_id',$data['matp'])->get();
                $output.='<option value="0">---Chọn xã/phường---</option>';
                foreach($select_ward as $ward){
                    $output.='<option value="'.$ward->id.'">'.$ward->name.'</option>';
                }
            }
        }
        echo $output;
    }
// Hàm lưu hình ảnh lên serve
   
// Hàm đăng tin bất động sản
    public function Add_Estate(Request $request){
    
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
        else
        {
            $txt_money=$request->txt_money;
            $user=User::find(Auth::user()->id);
            $money=$user->SoTien;

            if($txt_money<=$money)
            {
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
                    $batdongsan->AnhDaiDien='no-img.jpg';  
                }
                $batdongsan->TongTien=$request->txt_money;
            
                $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
                $batdongsan->ThoiGianTaoBDS=$dateTime;

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

                $response=[
                    'id_bds'=>$idBDS,
                    'success'=>"success",
                ];
            }
            else
            {
                $response=[
                    'err'=>"err",
                ];
            }
         } 
            return response()->json([
                $response, 
            ],200);
    }

    // Hàm lưu hình ảnh bất động sản
    public function image_estate(Request $request){
      
        if($request->hasFile('file'))
        {
            $image=$request->file('file');
            foreach($image as $img){
                $image_estate=new HinhAnh();
                $id_bds=$request->id_bds;
                $imageName = strtotime(now()).rand(11111,99999).'.'.$img->getClientOriginalExtension();
                $image_estate->id_BDS=$id_bds;
                $image_estate->TenAnh=$imageName;
                $img->move(public_path().'/image/estates/',$imageName);
                $image_estate->save();
            }
            if(!is_dir(public_path().'/image/estates/')){
                mkdir(public_path().'/image/estates/',0777,true);
            }

            return response()->json([
                'status'=>"Success",
            ]);
        }
    }

    // Hàm duyệt bài đăng
    public function approve_estate(Request $request){
        try {
            $bds=new BatDongSan();
            $idBDS=$request->id_bds;
            $bds=BatDongSan::find($idBDS);
            $ngaybatdau=strtotime($bds->NgayBatDau);
            $ngaykethuc=strtotime($bds->NgayKetThuc);
            $datediff=abs($ngaybatdau-$ngaykethuc);
            $numberDate=floor($datediff / (60*60*24));

            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $date_start=$dateTime->toDateString();
            $date_end=$dateTime->addDays($numberDate)->toDateString();

            $bds->NgayBatDau=$date_start;
            $bds->NgayKetThuc=$date_end;

            $bds->HienThiBDS=1;
            $bds->idUserPost=Auth::id();
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $bds->ThoiGianTaoBDS=$dateTime;
            $bds->save();
            return response()->json([
                'success'=>'Duyệt bài thành công',
            ],200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'err'=>'Duyệt bài không thành công',
            ],200);
        }   
    }
    // Hàm gỡ bài đăng
    public function remove_estate(Request $request){
        try {
            $bds=new BatDongSan();
            $idBDS=$request->id_bds;
            $bds=BatDongSan::find($idBDS);
            $bds->HienThiBDS=0;
            $bds->idUserPost=Auth::id();
            $dateTime=Carbon::now('Asia/Ho_Chi_Minh');
            $bds->ThoiGianXoaBDS=$dateTime;
            $bds->save();
            return response()->json([
                'success'=>'Gỡ bài thành công',
            ],200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'err'=>'Gỡ bài không thành công',
            ],200);
        }   
    }
    // Ham xem chi tiet bai dang
    public function estate_detail(Request $request){
        $id_bds=$request->id_bds;
        $batdongsan=BatDongSan::join('districts','districts.id','=','bat_dong_san.id_QuanHuyen')
                                ->join('provinces','provinces.id','=','bat_dong_san.id_TinhThanh')
                                ->join('wards','wards.id','=','bat_dong_san.id_XaPhuong')
                                ->join('chi_tiet_bat_dong_san','chi_tiet_bat_dong_san.id_BDS','=','bat_dong_san.idBDS')
                                ->leftjoin('danh_muc','danh_muc.idDanhMuc','=','chi_tiet_bat_dong_san.id_DanhMuc')
                                ->join('loai_tin','loai_tin.idLoaiTin','=','bat_dong_san.id_LoaiTin')
                                ->join('user','user.id','=','bat_dong_san.id_User')
                                ->where('idBDS',$id_bds)
                                ->select('*','districts.name AS dic','provinces.name AS pro','wards.name AS war','danh_muc.TieuDeDanhMuc AS TieuDeDM','bat_dong_san.HienThiBDS AS Show')
                                ->first();
        $hinhanh=HinhAnh::where('id_BDS',$id_bds)->get();
                                
        return response()->json([
            'bds'=>$batdongsan,
            'hinhanh'=>$hinhanh,
        ]);
        
    }

    // Ham remote image dropzone
    public function remote_image(Request $request){
        $filename=$request->idFileName;
        $image=HinhAnh::where('TenAnh',basename($filename))->first();
        if(empty($image)){

            return response()->json([
                'message'=>'File does exits',
            ],400);
        }
        $file_path=public_path('image/estates/');
        $path=$file_path.'/'.$image->TenAnh;
        if(file_exists($path)){
            unlink($path);
        }
        if(!empty($image)){
            $image->delete();
        }
        return response()->json([
            'message'=>'File delete success',
        ],200);
    }
// ham chinh sua anh
    public function editImage(Request $request){
        if($request->hasFile('file')){
            $image=$request->file('file');
            foreach($image as $row){
                $hinhanh=new HinhAnh();
                $txt_id_bds=$request->txt_id_bds;
                $imageName = strtotime(now()).rand(11111,99999).'.'.$row->getClientOriginalExtension();
                $hinhanh->id_BDS=$txt_id_bds;
                $hinhanh->TenAnh=$imageName;
                $row->move(public_path().'/image/estates/',$imageName);
                $hinhanh->save();
            }
            return response()->json([
                'message'=>'File success',
            ]);
        }
    }


    // Ham xoa bat dong san
    public function delete_estate(Request $request){
        $txt_id_bds=$request->txt_id_bds;
        $hinhanh=HinhAnh::where('id_BDS',$txt_id_bds)->get();
        $file_path=public_path('image/estates/');
        foreach($hinhanh as $image){
            $img=HinhAnh::find($image->idHinhAnh);
            $img->delete();
            $path=$file_path.'/'.$image->TenAnh;
            if(file_exists($path)){
                unlink($path);
            }
        }
        $chitietBDS=ChiTietBatDongSan::where('id_BDS',$txt_id_bds)->get();
        foreach($chitietBDS as $row){
            $chitiet=ChiTietBatDongSan::find($row->idChiTietBDS);
            $chitiet->delete();
        }
        $batdongsan=BatDongSan::find($txt_id_bds);
        $batdongsan->delete();

        return response()->json([
            'message'=>"Xóa thành công!",
        ],200);
    }
}
