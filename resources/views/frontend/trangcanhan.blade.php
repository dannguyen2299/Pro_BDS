@extends('frontend.master.master')
@section('title','Trang ca nhan')
@section('content')

<script>
    $(document).ready(function(){
        $("#frm_editUser").validate({
            rules:{
                txt_ho_user:{
                    required:true,
                },
                txt_ten_user:{
                    required:true,    
                },
                txt_gioitinh_user:{
                    required:true,
                },
                txt_diachi_user:{
                    required:true,
                },
                txt_sdt_user:{
                    required:true,
                    digits:true,
                    minlength:10,
                    maxlength:10,
                    
                },
                txt_email_user:{
                    required:true,
                    email:true,
                    
                },
               
            },
            messages:{
                txt_ho_user:{
                    required:"*Vui lòng nhập vào trường này", 
                },
                txt_ten_user:{
                    required:"*Vui lòng nhập vào trường này", 
                },
                txt_gioitinh_user:{
                    required:"*Vui lòng nhập vào trường này", 
                },
                txt_diachi_user:{
                    required:"*Vui lòng nhập vào trường này", 
                },
                txt_sdt_user:{
                    required:"*Vui lòng nhập vào trường này",
                    digits:"*Số điện thoại phải là chữ số",
                    minlength:"*Số điện thoại phải có 10 chữ số",
                    maxlength:"*Số điện thoại phải có 10 chữ số",
                    remote:"*Số điện thoại đã tồn tại, vui lòng nhập số khác",
                },
                txt_email_user:{
                    required:"*Vui lòng nhập vào trường này",
                    email:"*Email không đúng định dạng",
                    remote:"*Email đã tồn tại, vui lòng nhập email khác",
                },
               
            },
        }); 
    });
</script>
    <section class="bds-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about pt-5">
            <div class="container pt-lg-5 py-3">
            </div>
        </div>
    </section>
    <section class="bds-breadcrumb">
        <div class="container">
            <ul class="breadcrumbs-custom-path">
                <li><a href="index.html">Trang chủ</a></li>
                <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span>Trang cá nhân</li>
                <!-- <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Contact Us</li> -->
            </ul>
        </div>
    </section>
    <!-- contacts -->
    <section class="bds-contact-7 pt-5" id="contact">
        <div class="contacts-9 pt-lg-5 pt-md-4">
            <div class="container-fluid">
                <div class="top-map pb-5">
                    <div class="row map-content-9">
                        <div class="col-lg-9">
                            <div class="contact-form">
                                <h5 class="mb-2 pb-3">Thông tin cá nhân</h5>
                                {{-- <p class="mb-4">Đăng tin</p> --}}
                                @csrf
                                <form id="frm_editUser" data-route="{{ route('editUser') }}" action="" method="post" class="">
                                    <label for="txt_ho">Mã khách hàng:  </label><p class="d-inline" id="txt_makh"> </p>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_ho_user">Họ:</label>
                                                <input type="text" class="form-control" id="txt_ho_user" name="txt_ho_user" placeholder="Họ...">
                                                <div id="show_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_ten_user">Tên:</label>
                                                <input type="text" class="form-control" id="txt_ten_user" name="txt_ten_user" placeholder="Tên...">
                                                <div id="show_error1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt_diachi_user">Địa chỉ</label>
                                        <input type="text" class="form-control" id="txt_diachi_user" name="txt_diachi_user" placeholder="Địa chỉ...">
                                        <div id="show_error4"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_sdt_user">Số điện thoại:</label>
                                                <input type="text" class="form-control" id="txt_sdt_user" name="txt_sdt_user" placeholder="Số điện thoại...">
                                                <div id="show_error2"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_gioitinh_user">Giới tính:</label>
                                                <select class="form-control" name="txt_gioitinh_user" id="txt_gioitinh_user">
                                                    {{-- <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option> --}}
                                                </select>
                                                <div id="show_error3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt_email_user">Email</label>
                                        <input type="email" class="form-control" id="txt_email_user" name="txt_email_user" placeholder="Email...">
                                        <div id="show_error5"></div>
                                    </div>
                                    
                                     <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                                    
                                </form>
                            </div>
                        </div>

                        @include('frontend.layout.layout')
                       
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- //contacts -->
    <script>
        $(function(){
            $("#frm_editUser").submit(function(e){
                var route=$("#frm_editUser").data('route');
                var form=$(this);
                $('.alert').remove();
                $.ajax({
                    type:'post',
                    url:route,
                    data:form.serialize(),
                    success:function(result){
                        for(var i=0;i<result.length;i++){
                            if(result[i].txt_ho_user){
                                $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_ho_user+'</p>');
                            }
                            if(result[i].txt_ten_user){
                                $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_ten_user+'</p>');
                            }
                            if(result[i].txt_sdt_user){
                                $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_sdt_user+'</p>');
                            }
                            if(result[i].txt_gioitinh_user){
                                $("#show_error3").append('<p class="alert alert-danger">'+result[i].txt_gioitinh_user+'</p>');
                            }
                            if(result[i].txt_diachi_user){
                                $("#show_error4").append('<p class="alert alert-danger">'+result[i].txt_diachi_user+'</p>');
                            }
                            if(result[i].txt_email_user){
                                $("#show_error5").append('<p class="alert alert-danger">'+result[i].txt_email_user+'</p>');
                            }
                        
                            
                            if(result[i].success){
                                    toastr.success(result[i].success,'Thong bao');
                                    window.location.href='/trang-ca-nhan';
                                }
                        }
                    }
                });
                e.preventDefault();
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url:'/infoUser',
                type:'post',
                success:function(result){
                    $("#txt_makh").html(result.user.id);
                    $("#txt_ho_user").val(result.user.Ho);
                    $("#txt_ten_user").val(result.user.Ten);
                    $("#txt_diachi_user").val(result.user.DiaChi);
                    $("#txt_sdt_user").val(result.user.Phone);

                    var gioitinh="";
                    gioitinh+="<option value='Nam'";
                    if(result.user.GioiTinh=="Nam"){
                        gioitinh+=" selected ";
                    }
                    gioitinh+=">Nam</option>";

                    gioitinh+="<option value='Nữ'";
                    if(result.user.GioiTinh=="Nữ"){
                        gioitinh+=" selected ";
                    }
                    gioitinh+=">Nữ</option>";
                    $("#txt_gioitinh_user").html(gioitinh);

                    $("#txt_email_user").val(result.user.email);
                    
                }
            });
        })
    </script>

    <script>
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'/infoUser',
                success:function(result){
                    console.log(result);
                    var str="";
                    
                       str+= "<h5 class='text-center'>Thông tin cá nhân</h5>";

                            str+="<h5 class='mt-4 pt-lg-3 text-center'>"+result.user.Ho+" "+result.user.Ten+"</h5>";
                            str+="<p style='font-size: 14px;'><span></span> Tài khoản tin rao: "+parseInt(result.user.SoTien).toLocaleString()+" đ</p>";
                                

                            str+="<p><span class='fa fa-phone'></span> <strong class='txt_info'>Tel :</strong>";
                                str+="<a class='txt_info' href='tel:"+result.user.Phone+"'> "+result.user.Phone+"</a></p>";

                            str+="<p> <span class='fa fa-envelope'></span> <strong class='txt_info'>Email :</strong>";
                                str+="<a class='txt_info' href='mailto:"+result.user.email+"'> "+result.user.email+"</a></p>";

                                str+="<p class='title'>Quản lý thông tin cá nhân</p>";
                                str+="<ul>";
                                    str+="<a href='../trang-ca-nhan'><li>Thay đổi thông tin cá nhân</li></a>";
                                    str+="<a href='' data-toggle='modal' data-target='#exampleModal'><li>Thay đổi mật khẩu</li></a>";
                                    str+="<a href='' data-toggle='modal' data-target='#exampleModal12'><li>Nạp tiền</li></a>";

                                str+="</ul>";

                                str+="<p class='title'>Quản lý tin đăng</p>";
                                str+="<ul>";
                                    str+="<a href='../danh-sach-tin-dang'><li>Danh sách tin đăng</li></a>";
                                    str+="<a href='../dang-tin'><li>Đăng tin</li></a>";
                                   
                                str+="</ul>";
                   

                        $("#info_user").html(str);
                }
                
            })
        });
    </script>

    <script>
        $(function(){
            $(".form_password .eye").click(function(){
                let $this=$(this);
                if($this.hasClass('active')){
                    $this.parents(".form_password").find('input').attr('type','password');
                    $this.removeClass('active');
                }
                else{
                    $this.parents(".form_password").find('input').attr('type','text');
                    $this.addClass('active');
                }
            });
        });
    </script>
    <script>
        $(function(){
            $("#frm_changePass").submit(function(e){
                var route=$("#frm_changePass").data('route');
                var form=$(this);
                $('.text-danger').remove();
                $.ajax({
                    type:'post',
                    url:route,
                    data:form.serialize(),
                    success:function(result){
                        for(var i=0;i<result.length;i++){
                            if(result[i].password_old){
                                $("#show_errors").append('<p class="text-danger">'+result[i].password_old+'</p>');
                            }
                            if(result[i].err){
                                $("#show_errors").append('<p class="text-danger">'+result[i].err+'</p>');

                            }
                            if(result[i].password){
                                $("#show_errors1").append('<p class="text-danger">'+result[i].password+'</p>');
                            }
                        
                            if(result[i].success){
                                toastr.success(result[i].success,'Thông báo');
                                
                            }
                        }
                    }
                });
                e.preventDefault();
            });
        });
    </script>
@endsection