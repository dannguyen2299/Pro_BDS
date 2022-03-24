@extends('backend.master.master')
@section('title','Sua danh muc')
@section('content')
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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Sửa Danh Mục</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Sửa danh mục</li>
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
                                    <h3 class="card-title">Sửa danh mục</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                @csrf
                                <div>
                                    <form id="frm_edit" method="POST" role="form" data-route="{{ route('editCategory') }}">
                                    <div class="card-body">
                                        <input type="hidden" name="txt_id_dm" id="txt_id_dm" />
                                        <div class="form-group">
                                            <label for="txt_tieude">Tiêu đề</label>
                                            <input type="text" class="form-control" id="txt_tieude" name="txt_tieude" placeholder="Tiêu đề danh mục..." onkeyup="to_slug();">
                                            <div id="show_error"></div>
                                        </div>

                                        <input type="hidden" id="tieude_slug" name="tieude_slug" />

                                        <div class="form-group">
                                            <label for="txt_danhmuccha">Danh mục cha</label>
                                            <select class="form-control select2" name="txt_danhmuccha" id="txt_danhmuccha">
                                                <option value="-1">Danh muc cao nhat</option>
                                               {{ GetCategory($category,-1,"",$cate->idDanhMucCha) }}
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="txt_hienthitrenmainnmenu" name="txt_hienthitrenmainnmenu">
                                                    <label for="txt_hienthitrenmaninmenu">Hiển thị trên Main Menu</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_vitritrenmainmenu">Vị trí trên Main Menu</label>
                                                    <input type="number" min="0" class="form-control" id="txt_vitritrenmainmenu" name="txt_vitritrenmainmenu" />
                                                    <div id="show_error1"></div>
                                                </div>

                                            </div>

                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="txt_hienthitrenheadmenu" name="txt_hienthitrenheadmenu">
                                                    <label for="txt_hienthitrenheadMenu">Hiển thị trên Head Menu</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="txt_vitritrenheadmenu">Vị trí trên Head Menu</label>
                                                    <input type="number" min="0" class="form-control" id="txt_vitritrenheadmenu" name="txt_vitritrenheadmenu" />
                                                    <div id="show_error2"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" id="txt_mota" name="txt_mota"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Nội dung</label>
                                            <textarea class="form-control" id="txt_noidung" name="txt_noidung"></textarea>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" id="btn_edit_dm" style="float: right;">Cap nhat</button>
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
                var url=window.location.pathname;
                var idDanhMuc=url.substring(url.lastIndexOf('=')+1);
                $("#txt_id_dm").val(idDanhMuc);
                $.ajax({
                    url:"/admin/get-id",
                    type:'POST',
                    data:{idDanhMuc:idDanhMuc},
                    success:function(result){
                        $("#txt_tieude").val(result.danhmuc.TieuDeDanhMuc);
                        $("#tieude_slug").val(result.danhmuc.TieuDeDanhMuc_Slug);
                        if(result.danhmuc.HienThiTrenMainMenu==1){
                            $("#txt_hienthitrenmainnmenu").attr('checked',true);
                        }
                        if(result.danhmuc.HienThiTrenHeadMenu==1){
                            $("#txt_hienthitrenheadmenu").attr('checked',true);
                        }
                       
                        $("#txt_vitritrenmainmenu").val(result.danhmuc.ViTriTrenMainMenu);
                        
                        $("#txt_vitritrenheadmenu").val(result.danhmuc.ViTriTrenHeadMenu);
                        $("#txt_mota").val(result.danhmuc.MoTaDanhMuc);
                        $("#txt_noidung").val(result.danhmuc.NoiDungDanhMuc);
                    }
                });

                // Cap nhat danh muc
                {{-- $("#btn_edit_dm").click(function(){
                    var form=$("#frm_edit")[0];
                    var data=new FormData(form);

                    $.ajax({
                        type:'post',
                        enctype: "multipart/form-data",
                        url:"/edit-category",
                        data:data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success:function(result){
                            //alert(result.id);
                             if(result=="-1"){
                                toastr.error('Thong bao!','Chinh sua that bai');
                            }
                            else{
                                toastr.success(result.message);
                                window.location.href='/admin/list-category';
                            } 
                        }

                    });
                }) --}}

            })

            $(function(){
                $("#frm_edit").submit(function(e){
                    var route=$('#frm_edit').data('route');
                    var form=$(this);
                    $('.alert').remove();
                    $.ajax({
                        type:'post',
                        url:route,
                        data:form.serialize(),
                        success: function(result){
                            console.log(result);
                             for(var i=0;i<result.length;i++){
                                if(result[i].txt_tieude){
                                    $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_tieude+'</p>');
                                }
                                if(result[i].txt_vitritrenmainmenu){
                                    $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_vitritrenmainmenu+'</p>');
                                }
                                if(result[i].txt_vitritrenheadmenu){
                                    $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_vitritrenheadmenu+'</p>');
                                }

                                if(result[i].success){
                                    toastr.success(result[i].success,'Thong bao');
                                    window.location.href='/admin/list-category';
                                }
                             }

                             
                            
                        }
                    });
                    e.preventDefault();
                });
            });
        </script>


       @endsection