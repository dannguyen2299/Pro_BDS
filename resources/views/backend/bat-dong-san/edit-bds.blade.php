@extends('backend.master.master')
@section('title','Them danh muc')
@section('content')


{{--  --}}
<script>
    var ChuSo=new Array(" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín ");
    var Tien=new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");


function DocSo3ChuSo(baso)
{
    var tram;
    var chuc;
    var donvi;
    var KetQua="";
    tram=parseInt(baso/100);
    chuc=parseInt((baso%100)/10);
    donvi=baso%10;
    if(tram==0 && chuc==0 && donvi==0) return "";
    if(tram!=0)
    {
        KetQua += ChuSo[tram] + " trăm ";
        if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
    }
    if ((chuc != 0) && (chuc != 1))
    {
            KetQua += ChuSo[chuc] + " mươi";
            if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
    }
    if (chuc == 1) KetQua += " mười ";
    switch (donvi)
    {
        case 1:
            if ((chuc != 0) && (chuc != 1))
            {
                KetQua += " mốt ";
            }
            else
            {
                KetQua += ChuSo[donvi];
            }
            break;
        case 5:
            if (chuc == 0)
            {
                KetQua += ChuSo[donvi];
            }
            else
            {
                KetQua += " lăm ";
            }
            break;
        default:
            if (donvi != 0)
            {
                KetQua += ChuSo[donvi];
            }
            break;
        }
    return KetQua;
}
    function DocTienBangChu()
    {
        var SoTien=$("#txt_gia").val();
        var lan=0;
        var i=0;
        var so=0;
        var KetQua="";
        var tmp="";
        var ViTri = new Array();
        if(SoTien<0) return "Số tiền âm !";
        if(SoTien==0) return "Không đồng !";
        if(SoTien>0)
        {
            so=SoTien;
        }
        else
        {
            so = -SoTien;
        }
        if (SoTien > 8999999999999999)
        {
            //SoTien = 0;
            return "Số quá lớn!";
        }
        ViTri[5] = Math.floor(so / 1000000000000000);
        if(isNaN(ViTri[5]))
            ViTri[5] = "0";
        so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
        ViTri[4] = Math.floor(so / 1000000000000);
        if(isNaN(ViTri[4]))
            ViTri[4] = "0";
        so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
        ViTri[3] = Math.floor(so / 1000000000);
        if(isNaN(ViTri[3]))
            ViTri[3] = "0";
        so = so - parseFloat(ViTri[3].toString()) * 1000000000;
        ViTri[2] = parseInt(so / 1000000);
        if(isNaN(ViTri[2]))
            ViTri[2] = "0";
        ViTri[1] = parseInt((so % 1000000) / 1000);
        if(isNaN(ViTri[1]))
            ViTri[1] = "0";
        ViTri[0] = parseInt(so % 1000);
    if(isNaN(ViTri[0]))
            ViTri[0] = "0";
        if (ViTri[5] > 0)
        {
            lan = 5;
        }
        else if (ViTri[4] > 0)
        {
            lan = 4;
        }
        else if (ViTri[3] > 0)
        {
            lan = 3;
        }
        else if (ViTri[2] > 0)
        {
            lan = 2;
        }
        else if (ViTri[1] > 0)
        {
            lan = 1;
        }
        else
        {
            lan = 0;
        }
        for (i = lan; i >= 0; i--)
        {
        tmp = DocSo3ChuSo(ViTri[i]);
        KetQua += tmp;
        if (ViTri[i] > 0) KetQua += Tien[i];
        if ((i > 0) && (tmp.length > 0)) KetQua += ',';//&& (!string.IsNullOrEmpty(tmp))
        }
    if (KetQua.substring(KetQua.length - 1) == ',')
    {
            KetQua = KetQua.substring(0, KetQua.length - 1);
    }
    KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
    $("#txt_sotien").html(KetQua);
}
</script>
<script>
    function to_slug() {
        var txt_tieude, tieude_slug;
        txt_tieude = $("#txt_tieude").val();
        // Chuyển hết sang chữ thường
        tieude_slug = txt_tieude.toLowerCase();

        // xóa dấu
        tieude_slug = tieude_slug.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        tieude_slug = tieude_slug.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        tieude_slug = tieude_slug.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        tieude_slug = tieude_slug.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        tieude_slug = tieude_slug.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        tieude_slug = tieude_slug.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        tieude_slug = tieude_slug.replace(/(đ)/g, 'd');

        // Xóa ký tự đặc biệt
        tieude_slug = tieude_slug.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        tieude_slug = tieude_slug.replace(/(\s+)/g, '-');

        // xóa phần dự - ở đầu
        tieude_slug = tieude_slug.replace(/^-+/g, '');

        // xóa phần dư - ở cuối
        tieude_slug = tieude_slug.replace(/-+$/g, '');

        // return
        //$("#txt_slug_category").val() = txt_slug_category;
        document.getElementById('tieude_slug').value = tieude_slug;
    }
</script>
{{--  --}}

<script>
    $(document).ready(function(){
        
         $("#frm_edit_bds").validate({
        rules:{
            txt_tieude:{
                required:true,
                minlength:6,
                maxlength:100,
            },
            txt_hinhthuc:{
                required:true,
            },
            txt_loaibds:{
                required:true,
            },
            txt_dientich:{
                digits: true,
                min:0,
            },
            txt_gia:{
                digits: true,
                min:0,
                step:0.1,
            },
            select_file:{
                extension: "jpeg|png|jpg",
            },
            txt_mota:{
                required: true,
                maxlength:3000,
            },
            txt_mattien:{
                digits: true,
                min:0,
            },
            txt_duongvao:{
                digits: true,
                min:0,
            },
            txt_sotang:{
                digits: true,
                min:0,
            },
            txt_sophongngu:{
                digits: true,
                min:0,
            },
            txt_sotoilet:{
                digits: true,
                min:0,
            },
            txt_tenlienhe:{
                required: true,  
            },
            txt_diachilienhe:{
                required: true,
                
            },
            txt_dienthoailienhe:{
                required: true,  
            },
            txt_emaillienhe:{
                email:true,
            }

        },
        messages:{
            txt_tieude:{
                required:"*Vui lòng nhập vào trường này",
                minlength:"*Không nhỏ hơn 6 ký tự",
                maxlength:"*Không lớn hơn 100 ký tự",
            },
            txt_hinhthuc:{
                required:"*Vui lòng nhập vào trường này",
            },
            txt_loaibds:{
                required:"*Vui lòng nhập vào trường này",
            },
            txt_dientich:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_gia:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            select_file:{
                extension:"*File ảnh phải đúng định dạng: jpg,png,jpeg",
            },
            txt_mota:{
                required:"*Vui lòng nhập vào trường này",
                maxlength:"*Không lớn hơn 3000 ký tự",
            },
            txt_mattien:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_duongvao:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_sotang:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_sophongngu:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_sotoilet:{
                digits:"*Dữ liệu nhập phải là số",
                min:"*Dữ liệu nhập không được số âm",
            },
            txt_tenlienhe:{
                required:"*Vui lòng nhập vào trường này",
            },
            txt_diachilienhe:{
                required:"*Vui lòng nhập vào trường này",
            },
            txt_dienthoailienhe:{
                required:"*Vui lòng nhập vào trường này",
            },
            txt_emaillienhe:{
                email:"*Email khong đúng định dạng",
            }
        }
    });
    })
   
</script>
<style>
    label.error {
    color:red!important;
    font-size: 13px;
}

</style>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Thêm Danh Mục</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Đăng tin</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Đăng tin</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                @csrf
                                <div>
                                     <form action="{{ route('edit_estate') }}" method="POST" enctype="multipart/form-data" role="form" name="frm_edit_bds" id="frm_edit_bds" class="dropzone">
                                        
                                    <div class="card-body">
                                        <input type="hidden" name="txt_id_bds" id="txt_id_bds">
                                        <div class="form-group">
                                            <label for="txt_tieude">Tiêu đề (<span class="text-danger">*</span>)</label>
                                            <input type="text" class="form-control" id="txt_tieude" name="txt_tieude" placeholder="Tiêu đề bất động sản..." onkeyup="to_slug();" >
                                            <div id="show_error"></div>
                                        </div>
                                        <input type="hidden" id="tieude_slug" name="tieude_slug" />
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="txt_hinhthuc">Hình thức (<span class="text-danger">*</span>)</label>
                                                    <select class="form-control select2 category parent_cate" name="txt_hinhthuc" id="txt_hinhthuc">
                                                        <option value="0">---Hình thức---</option>
                                                        @foreach ($hinhthuc as $row)
                                                            <option value="{{ $row->idDanhMuc }}" {{ $row->idDanhMuc==$bds->HinhThuc ? 'selected' : '' }}>{{ $row->TieuDeDanhMuc }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="show_error1"></div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="txt_loaibds">Loại (<span class="text-danger">*</span>)</label>
                                                    <select class="form-control select2 kind" name="txt_loaibds" id="txt_loaibds">
                                                        @foreach ($loai as $row)
                                                            <option value="{{ $row->idDanhMuc }}" {{ $row->idDanhMuc==$bds->LoaiBDS ? 'selected' : '' }}>{{ $row->TieuDeDanhMuc }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div id="show_error2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_tinhthanh">Tỉnh/Thành phố (<span class="text-danger">*</span>)</label>
                                                    <select class="form-control select2 choose city" name="txt_tinhthanh" id="txt_tinhthanh">
                                                        <option value="">---Tỉnh/Thành---</option>
                                                        @foreach ($city as $row)
                                                           <option value="{{ $row->id }}" {{ $row->id==$bds->id_TinhThanh ? 'selected' : '' }}>{{ $row->name }}</option> 
                                                        @endforeach
                                                    </select>
                                                    {{-- <div id="show_error2"></div> --}}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_quanhuyen">Quận/Huyện (<span class="text-danger">*</span>)</label>
                                                    <select class="form-control select2 choose districts" name="txt_quanhuyen" id="txt_quanhuyen">
                                                        
                                                        @foreach ($district as $row)
                                                            <option value="{{ $row->id }}" {{ $row->id==$bds->id_QuanHuyen ? 'selected' : '' }}>{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <div id="show_error4"></div> --}}
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_phuongxa">Phường/Xã (<span class="text-danger">*</span>)</label>
                                                    <select class="form-control select2 wards" name="txt_phuongxa" id="txt_phuongxa">
                                                        @foreach ($ward as $row)
                                                            <option value="{{ $row->id }}" {{ $row->id==$bds->id_XaPhuong ? 'selected' : '' }}>{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <div id="show_error5"></div> --}}
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_dientich">Diện tích (m²)</label>
                                                    <input type="number" min="0" value="0" step="0.1"  class="form-control" id="txt_dientich" name="txt_dientich" placeholder="Diện tích...">
                                                    <div id="show_error3"></div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_gia">Giá</label>
                                                    <input type="number" min="0" value="0" class="form-control" id="txt_gia" name="txt_gia" placeholder="Giá..." onkeyup="DocTienBangChu();">
                                                    <div id="show_error4"></div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_donvi">Đơn vị</label>
                                                    <select class="form-control" name="txt_donvi" id="txt_donvi">
                                                        <option value="">---Đơn vị---</option>
                                                        <option value="Tỷ">Tỷ</option>
                                                        <option value="Triệu">Triệu</option>
                                                    </select>
                                                    <div id="show_error"></div>
                                                </div>
                                            </div> --}}
                                        </div>
                                     
                                       <p class="text-danger" id="txt_sotien"></p>
                                      
                                        <div class="form-group">
                                            <label for="txt_diachi">Địa chỉ (<span class="text-danger">*</span>)</label>
                                            <input type="text" class="form-control" id="txt_diachi" name="txt_diachi" placeholder="Địa chỉ...">
                                            <div id="show_error5"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ảnh đại diện</label>
                                            <div>
                                              <input id="select_file" type="file" name="select_file" class="form-control hidden" style="display: none;"
                                                onchange="changeImg(this)">
                                            <img id="avatar" class="thumbnail" width="200px" height="150px" src="../image/avatar/estate/{{ $bds->AnhDaiDien }}" alt="{{ $bds->AhDaiDien }}" style="cursor: pointer;border-style:groove;">
                                            </div>
                                            <div id="show_error3"></div>
                                            
    
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" id="txt_mota" name="txt_mota" rows="5" placeholder="Mô tả..."></textarea>
                                            <div id="show_error6"></div>
                                        </div>

                                        <div class="form-group">
                                            <label>Nội dung</label>
                                            <textarea class="form-control" id="summernote" name="txt_noidung" rows="5" placeholder="Nội dung...">{{ $bds->NoiDungBDS }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="txt_mattien">Mặt tiền (m)</label>
                                                    <input type="number" min="0" step="0.1" value="0" class="form-control" id="txt_mattien" name="txt_mattien" placeholder="Mặt tiền...">
                                                    <div id="show_error7"></div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="txt_duongvao">Đường vào (m)</label>
                                                    <input type="number" min="0" step="0.1" value="0" class="form-control" id="txt_duongvao" name="txt_duongvao" placeholder="Đường vào...">
                                                    <div id="show_error8"></div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="txt_huongnha">Hướng nhà</label>
                                                    <select class="form-control" name="txt_huongnha" id="txt_huongnha">
                                                        
                                                    </select>
                                                    {{-- <div id="show_error12"></div> --}}
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="txt_huongbancong">Hướng ban công</label>
                                                    <select class="form-control" name="txt_huongbancong" id="txt_huongbancong">
                                                       
                                                    </select>
                                                    {{-- <div id="show_error13"></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_sotang">Số tầng</label>
                                                    <input type="number" min="0" class="form-control" value="0" id="txt_sotang" name="txt_sotang" placeholder="Số tầng...">
                                                    <div id="show_error9"></div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_sophongngu">Số phòng ngủ</label>
                                                    <input type="number" min="0" class="form-control" value="0" id="txt_sophongngu" name="txt_sophongngu" placeholder="Số phòng ngủ...">
                                                    <div id="show_error10"></div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_sotoilet">Số Toilet</label>
                                                    <input type="number" class="form-control" value="0" id="txt_sotoilet" name="txt_sotoilet" placeholder="Số toilet...">
                                                    <div id="show_error11"></div>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="form-group">
                                            <label>Nội thất</label>
                                            <textarea class="form-control" id="txt_noithat" name="txt_noithat" rows="3" placeholder="Nội thất"></textarea>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Thông tin pháp lý</label>
                                            <textarea class="form-control" id="txt_phaply" name="txt_phaply" rows="3" placeholder="Ví dụ: Đã có sổ hồng, Sổ đỏ,..."></textarea>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="txt_diachi">Hình ảnh</label>
                                            <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                                                <span>Upload file</span>
                                            </div>
                                            <div class="dropzone-previews"></div>

                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_tenlienhe">Tên liên hệ</label>
                                                    <input type="text" class="form-control" id="txt_tenlienhe" name="txt_tenlienhe" placeholder="Tên liên hệ...">
                                                    <div id="show_error12"></div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="txt_diachilienhe">Địa chỉ</label>
                                                    <input type="text" class="form-control" id="txt_diachilienhe" name="txt_diachilienhe" placeholder="Địa chỉ liên hệ...">
                                                    <div id="show_error13"></div>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_dienthoailienhe">Điện thoại</label>
                                                    <input type="text" class="form-control" id="txt_dienthoailienhe" name="txt_dienthoailienhe" placeholder="Điện thoại liên hệ...">
                                                    <div id="show_error14"></div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="txt_emaillienhe">Email</label>
                                                    <input type="text" class="form-control" id="txt_emaillienhe" name="txt_emaillienhe" placeholder="Email...">
                                                    {{-- <div id="show_error"></div> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_loaitin">Loại tin rao</label>
                                                    <select class="form-control" name="txt_loaitin" id="txt_loaitin">
                                                        {{-- <option value="1">Tin thường</option>
                                                        <option value="2">Tin VIP</option> --}}
                                                    </select>
                                                    {{-- <div id="show_error"></div> --}}
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_ngaybatdau">Ngày bắt đầu</label>
                                                    <input type="date" class="form-control" id="txt_ngaybatdau" name="txt_ngaybatdau" >
                                                    <div id="show_error15"></div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_ngayketthuc">Ngày kết thúc</label>
                                                    <input type="date" class="form-control" id="txt_ngayketthuc" name="txt_ngayketthuc" >
                                                    <div id="show_error16"></div>
                                                </div>
                                            </div>
                                        </div>
                               
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <input type="submit" id="btn_add_dm" class="btn btn-primary" style="float: right;">Thêm mới
                                    </div>
                                </form>
                                </div>
                               
                            </div>
                          

                        </div>
                      
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <script>
            $(document).ready(function(){

                $('.choose').on('change',function(){
                    var action=$(this).attr('id');
                    var matp=$(this).val();
                    
                    var _token=$('input[name="_token"]').val();
                    var result='';
                    var url=window.location.pathname;
                    var idBDS=url.substring(url.lastIndexOf('=')+1);
                    $("#txt_id_bds").val(idBDS);
                    if(action=='txt_tinhthanh'){
                        result='txt_quanhuyen';
                    }
                    else{
                        result='txt_phuongxa';
                    }
                    $.ajax({
                        url:'{{url('/select_location')}}',
                        method:'post',
                        data:{action:action,matp:matp,_token:_token,idBDS:idBDS},
                        success:function(data){
                            $('#'+result).html(data);
                        }
                    });
                });
            });
            
        </script>
         <script>
            $(document).ready(function(){
                $('.category').on('change',function(){
                    var action=$(this).attr('id');
                    var id_dm=$(this).val();
                    var _token=$('input[name="_token"]').val();
                    var result='';
                    if(action=='txt_hinhthuc'){
                        result='txt_loaibds';
                    }
                    $.ajax({
                        url:'{{ url('/select_category') }}',
                        method:'post',
                        data:{action:action,id_dm:id_dm,_token:_token},
                        success:function(data)
                        {
                            $('#'+result).html(data);
                        }
                    });
                });
            });
    

          
           
        </script> 

<script>
    Dropzone.autoDiscover = false;
    
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
        
    var myDropzone = new Dropzone("div#dropzoneDragArea", { 
        
        url: "{{ url('/admin/editImage') }}",
        previewsContainer: 'div.dropzone-previews',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        paramName: "file",
        parallelUploads: 100,
        maxFiles: 100,
        
        params: {
            _token: token
        },
         
        init: function() {
            var myDropzone = this;
            $("form[name='frm_edit_bds']").submit(function(event) {
                event.preventDefault();
                URL = $("#frm_edit_bds").attr('action');
                $('.alert').remove();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    processData: false,
                    cache:false,
                    success: function(result){
                        if(result[0].success == "success")
                        {
                            var txt_id_bds = result.txt_id_bds;
                            $("#txt_id_bds").val(txt_id_bds); // inseting userid into hidden input field
                            toastr.success('Chỉnh sửa tin đăng thành công!','Thong bao');
                            myDropzone.processQueue();
                            window.location.href="../admin/estate";
                        }
                        else
                        {
                            for(var i=0;i<result.length;i++){
                                if(result[i].txt_tieude){
                                    $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_tieude+'</p>');
                                }
                                if(result[i].txt_hinhthuc){
                                    $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_hinhthuc+'</p>');
                                }
                                if(result[i].txt_loaibds){
                                    $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_loaibds+'</p>');
                                }
                                if(result[i].txt_dientich){
                                    $("#show_error3").append('<p class="alert alert-danger">'+result[i].txt_dientich+'</p>');
                                }
                                if(result[i].txt_gia){
                                    $("#show_error4").append('<p class="alert alert-danger">'+result[i].txt_gia+'</p>');
                                }
                                if(result[i].txt_diachi){
                                    $("#show_error5").append('<p class="alert alert-danger">'+result[i].txt_diachi+'</p>');
                                }
                                if(result[i].txt_mota){
                                    $("#show_error6").append('<p class="alert alert-danger">'+result[i].txt_mota+'</p>');
                                }
                                if(result[i].txt_mattien){
                                    $("#show_error7").append('<p class="alert alert-danger">'+result[i].txt_mattien+'</p>');
                                }
                                if(result[i].txt_duongvao){
                                    $("#show_error8").append('<p class="alert alert-danger">'+result[i].txt_duongvao+'</p>');
                                }
                                if(result[i].txt_sotang){
                                    $("#show_error9").append('<p class="alert alert-danger">'+result[i].txt_sotang+'</p>');
                                }
                                if(result[i].txt_sophongngu){
                                    $("#show_error10").append('<p class="alert alert-danger">'+result[i].txt_sophongngu+'</p>');
                                }
                                if(result[i].txt_sotoilet){
                                    $("#show_error11").append('<p class="alert alert-danger">'+result[i].txt_sotoilet+'</p>');
                                }
                               
                                if(result[i].txt_tenlienhe){
                                    $("#show_error12").append('<p class="alert alert-danger">'+result[i].txt_tenlienhe+'</p>');
                                }
                                if(result[i].txt_diachilienhe){
                                    $("#show_error13").append('<p class="alert alert-danger">'+result[i].txt_diachilienhe+'</p>');
                                }
                                if(result[i].txt_dienthoailienhe){
                                    $("#show_error14").append('<p class="alert alert-danger">'+result[i].txt_dienthoailienhe+'</p>');
                                }
                                if(result[i].txt_ngaybatdau){
                                    $("#show_error15").append('<p class="alert alert-danger">'+result[i].txt_ngaybatdau+'</p>');
                                }
                                if(result[i].txt_ngayketthuc){
                                    $("#show_error16").append('<p class="alert alert-danger">'+result[i].txt_ngayketthuc+'</p>');
                                }
                            }
                        }
                    }
                });
            });
            var urls=window.location.pathname;
            var idBDS=urls.substring(urls.lastIndexOf('=')+1);
            $("#txt_id_bds").val(idBDS);
            
            $.ajax({
                type:'post',
                url:'/admin/get-id-bds',
                data:{txt_id_bds:idBDS},
                dataType: 'json',
                success:function(result){
                  
                    for(let i=0;i<result.hinhanh.length;i++){
                        let img=result.hinhanh[i];
                        // let path='asset("uploads/images/"+img.image)';
                        var mockFile={name:img.TenAnh,status: Dropzone.ADDED,accepted: true};
                        // myDropzone.addFile(mockFile);
                        myDropzone.emit('addedfile',mockFile);
    
                        myDropzone.emit("thumbnail",mockFile,"../image/estates/"+img.TenAnh);
    
                         myDropzone.emit("complete", mockFile);
                        myDropzone.files.push(mockFile);
                        $("[data-dz-thumbnail]").css("height", "100%");
                            $("[data-dz-thumbnail]").css("width", "100%");
                            $("[data-dz-thumbnail]").css("object-fit", "cover");
                            $("[data-dz-size]").css("display", "none");
                    }
                }
            })
           
            this.on('sending', function(file, xhr, formData){
                let txt_id_bds = document.getElementById('txt_id_bds').value;
                
               formData.append('txt_id_bds', txt_id_bds);
               
            });
            this.on("removedfile",function(file){
                $.ajax({
                    type:'post',
                    url:'/admin/remote_image',
                    data:{idFileName:file.name},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                    }
                })
            });
            
            this.on("success", function (file, response) {
                $('#frm_edit_bds')[0].reset();
                $('.dropzone-previews').empty();
            });
            this.on("queuecomplete", function () {});
            this.on("sendingmultiple", function(file) {}); 
            this.on("successmultiple", function(files, response) {  });
            this.on("errormultiple", function(files, response) { });
        }
        });
    });
    </script>

        <script>
            $(document).ready(function(){
                var url=window.location.pathname;
                var idBDS=url.substring(url.lastIndexOf('=')+1);
                $("#txt_id_bds").val(idBDS);
                $.ajax({
                    url:'/admin/get-id-bds',
                    type:'post',
                    data:{idBDS:idBDS},
                    
                    success:function(result){
                        console.log(result);
                        $("#txt_tieude").val(result.bds.TieuDeBDS);
                        $("#txt_dientich").val(result.bds.DienTich);
                        $("#txt_gia").val(result.bds.GiaTienBDS);
                        $("#txt_diachi").val(result.bds.DiaChiBDS);
                        $("#txt_mota").val(result.bds.MoTaBDS);
                        // $("#txt_noidung").val(result.bds.NoiDungBDS);
                        $("#txt_mattien").val(result.bds.MatTien);
                        $("#txt_duongvao").val(result.bds.DuongVao);
                        

                        var huongnha="";
                        huongnha+="<option value='KXĐ'";
                        if(result.bds.HuongNha=="KXĐ"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">---KXĐ---</option>";

                        huongnha+="<option value='Đông'";
                        if(result.bds.HuongNha=="Đông"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông</option>";
                        huongnha+="<option value='Tây'";
                        if(result.bds.HuongNha=="Tây"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây</option>";
                        huongnha+="<option value='Nam'";
                        if(result.bds.HuongNha=="Nam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Nam</option>";
                        huongnha+="<option value='Bắc'";
                        if(result.bds.HuongNha=="Bắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Bắc</option>";
                        huongnha+="<option value='ĐôngBắc'";
                        if(result.bds.HuongNha=="ĐôngBắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông - Bắc</option>";
                        huongnha+="<option value='TâyBắc'";
                        if(result.bds.HuongNha=="TâyBắc"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây - Bắc</option>";

                        huongnha+="<option value='TâyNam'";
                        if(result.bds.HuongNha=="TâyNam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Tây - Nam</option>";

                        huongnha+="<option value='ĐôngNam'";
                        if(result.bds.HuongNha=="ĐôngNam"){
                            huongnha+=" selected ";
                        }
                        huongnha+=">Đông - Nam</option>";
                        $("#txt_huongnha").html(huongnha);

                        var huongbancong="";
                        huongbancong+="<option value='KXĐ'";
                        if(result.bds.HuongBanCong=="KXĐ"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">---KXĐ---</option>";

                        huongbancong+="<option value='Đông'";
                        if(result.bds.HuongBanCong=="Đông"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông</option>";
                        huongbancong+="<option value='Tây'";
                        if(result.bds.HuongBanCong=="Tây"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây</option>";
                        huongbancong+="<option value='Nam'";
                        if(result.bds.HuongBanCong=="Nam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Nam</option>";
                        huongbancong+="<option value='Bắc'";
                        if(result.bds.HuongBanCong=="Bắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Bắc</option>";
                        huongbancong+="<option value='ĐôngBắc'";
                        if(result.bds.HuongBanCong=="ĐôngBắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông - Bắc</option>";
                        huongbancong+="<option value='TâyBắc'";
                        if(result.bds.HuongBanCong=="TâyBắc"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây - Bắc</option>";

                        huongbancong+="<option value='TâyNam'";
                        if(result.bds.HuongBanCong=="TâyNam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Tây - Nam</option>";

                        huongbancong+="<option value='ĐôngNam'";
                        if(result.bds.HuongBanCong=="ĐôngNam"){
                            huongbancong+=" selected ";
                        }
                        huongbancong+=">Đông - Nam</option>";
                        $("#txt_huongbancong").html(huongbancong);

                        
                        $("#txt_sotang").val(result.bds.SoTang);
                        $("#txt_sophongngu").val(result.bds.SoPhongNgu);
                        $("#txt_sotoilet").val(result.bds.SoToilet);
                        $("#txt_noithat").val(result.bds.NoiThat);
                        $("#txt_phaply").val(result.bds.ThongTinPhapLy);
                        $("#txt_tenlienhe").val(result.bds.TenLienHe);
                        $("#txt_diachilienhe").val(result.bds.DiaChiLienHe);
                        $("#txt_dienthoailienhe").val(result.bds.DienThoai);
                        $("#txt_emaillienhe").val(result.bds.emailUser);
                        var loaitin="";
                        loaitin+="<option value='1'";
                        if(result.bds.LoaiTin=="Tin thường"){
                            loaitin+=" selected ";
                        }
                        loaitin+=">Tin thường</option>";
                        loaitin+="<option value='2'";
                        if(result.bds.LoaiTin=="Tin VIP"){
                            loaitin+=" selected ";
                        }
                        loaitin+=">Tin VIP</option>";
                        $("#txt_loaitin").html(loaitin);

                        $("#txt_ngaybatdau").val(result.bds.NgayBatDau);
                        $("#txt_ngayketthuc").val(result.bds.NgayKetThuc);
                    }
                });
            });
        </script>
     
      @endsection