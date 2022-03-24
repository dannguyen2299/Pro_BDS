<!DOCTYPE html>

<html lang="zxx">

<head>
    <title>Đăng ký</title>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="{{ asset('').'frontend/' }}">
    <!-- //Meta tags -->
    <link rel="stylesheet" href="./assets/css/signup.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/app.css">
    <!-- font-awesome-icons -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="../css/site.css">
    <script src="../backend/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(function(){
            $("#frm_register").validate({
                rules:{
                    txt_ho:{
                        required:true,
                    },
                    txt_ten:{
                        required:true,    
                    },
                    txt_gioitinh:{
                        required:true,
                    },
                    txt_diachi:{
                        required:true,
                    },
                    txt_sdt:{
                        required:true,
                        digits:true,
                        minlength:10,
                        maxlength:10,
                        remote:'/validate-phone',
                    },
                    txt_email:{
                        required:true,
                        email:true,
                        remote:'/validate-email',
                    },
                    password:{
                        required:true,
                        minlength:8, 
                    },
                    password_confirmation:{
                        required: true,
						minlength: 8,
						equalTo: "#password"
                    },
                },
                messages:{
                    txt_ho:{
                        required:"*Vui lòng nhập vào trường này", 
                    },
                    txt_ten:{
                        required:"*Vui lòng nhập vào trường này", 
                    },
                    txt_gioitinh:{
                        required:"*Vui lòng nhập vào trường này", 
                    },
                    txt_diachi:{
                        required:"*Vui lòng nhập vào trường này", 
                    },
                    txt_sdt:{
                        required:"*Vui lòng nhập vào trường này",
                        digits:"*Số điện thoại phải là chữ số",
                        minlength:"*Số điện thoại phải có 10 chữ số",
                        maxlength:"*Số điện thoại phải có 10 chữ số",
                        remote:"*Số điện thoại đã tồn tại, vui lòng nhập số khác",
                    },
                    txt_email:{
                        required:"*Vui lòng nhập vào trường này",
                        email:"*Email không đúng định dạng",
                        remote:"*Email đã tồn tại, vui lòng nhập email khác",
                    },
                    password:{
                        required:"*Vui lòng nhập vào trường này",
                        minlength:"*Độ dài mật khẩu ít nhất 8 ký tự",
                    },
                    password_confirmation:{
                        required:"*Vui lòng nhập vào trường này",
                        minlength:"*Độ dài ít nhất 8 ký tự",
                        equalTo:"*Mật khẩu không trùng nhau",
                    },
                },
            }); 
        });
    </script>
</head>

<body>
    <section class="w3l-form-36">
        <div class="form-36-mian section-gap">
            <div class="wrapper">
                <div class="form-inner-cont">
                    <h3 class="text-center">ĐĂNG KÝ</h3>
                    @csrf
                    <div>
                        
                        <form id="frm_register" method="post" role="form" data-route="{{ route('register') }}" class="signin-form" style="width:500px; margin:0px auto;">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group"> 
                                        <span class="fa fa-user-o icon1" aria-hidden="true"></span> <input type="text" class="form-control" name="txt_ho" id="txt_ho" placeholder="Họ..."  />
                                        
                                    </div>
                                    <div id="show_error"></div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <span class="fa fa-user-o icon1" aria-hidden="true"></span> <input type="text" class="form-control" name="txt_ten" id="txt_ten" placeholder="Tên..."  />
                                        
                                    </div>
                                    <div id="show_error1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    
                                    <div class="form-group">
                                    
                                        <span class="fa fa-user-o icon1" aria-hidden="true"></span> <input type="text" class="form-control" name="txt_sdt" placeholder="Số điện thoại..."  />
                                        
                                    </div>
                                    <div id="show_error2"></div>
                                </div>
                                {{-- <div class="col-2"></div> --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <span class="fa fa-user-o icon1" aria-hidden="true"></span>
                                        <select name="txt_gioitinh" id="txt_gioitinh" class="form-control">
                                            <option class="opt" value="0">---Giới tính---</option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                        
                                    </div>
                                    <div id="show_error3"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="fa fa-envelope-o icon" aria-hidden="true"></span> <input type="text" class="form-control" name="txt_diachi" placeholder="Địa chỉ..."  />
                                
                            </div>
                            <div id="show_error4"></div>
                            <div class="form-group">
                                <span class="fa fa-envelope-o icon" aria-hidden="true"></span> <input type="email" class="form-control" name="txt_email" placeholder="Email"  />
                                
                            </div>
                            <div id="show_error5"></div>
                            <div class="form-group">
                                <span class="fa fa-key icon" aria-hidden="true"></span><input type="password" class="form-control" id="password" name="password" placeholder="Password"  />
                            </div>
                            <div class="form-group">
                                <span class="fa fa-key icon" aria-hidden="true"></span> <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"  />
                                
                            </div>
                            <div id="show_error6"></div>

                            <div class="login-remember d-grid">
                               
                                <button type="submit" class="btn theme-button">ĐĂNG KÝ</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-icons">
                        <p class="continue"><span>Or</span></p>
                        <div class="social-login">
                            <a href="#facebook">
                                <div class="facebook">
                                    <span class="fa fa-facebook" aria-hidden="true"></span>

                                </div>
                            </a>
                            <a href="#google">
                                <div class="google">
                                    <span class="fa fa-google-plus" aria-hidden="true"></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <p class="signup text-center">Already a member? <a href="../dang-nhap" class="signuplink">Login</a></p>
                </div>


            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>

    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
    </script>
    {{-- <script src="../js/app.js"></script> --}}
    <script>
        $(function(){
            $("#frm_register").submit(function(e){
                var route=$('#frm_register').data('route');
                var form=$(this);
                $('.alert').remove();
                $.ajax({
                    type:'POST',
                    url:route,
                    "_token": "{{ csrf_token() }}",
                    data:form.serialize(),
                    success:function(result){
                        for(var i=0;i<result.length;i++){
                            if(result[i].txt_ho){
                                $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_ho+'</p>');
                            }
                            if(result[i].txt_ten){
                                $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_ten+'</p>');
                            }
                            if(result[i].txt_sdt){
                                $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_sdt+'</p>');
                            }
                            if(result[i].txt_gioitinh){
                                $("#show_error3").append('<p class="alert alert-danger">'+result[i].txt_gioitinh+'</p>');
                            }
                            if(result[i].txt_diachi){
                                $("#show_error4").append('<p class="alert alert-danger">'+result[i].txt_diachi+'</p>');
                            }
                            if(result[i].txt_email){
                                $("#show_error5").append('<p class="alert alert-danger">'+result[i].txt_email+'</p>');
                            }
                            if(result[i].password){
                                $("#show_error6").append('<p class="alert alert-danger">'+result[i].password+'</p>');
                            }
                           
                            if(result[i].success){
                                    toastr.success(result[i].success,'Thong bao');
                                    window.location.href='/dang-nhap';
                                }
                        }
                    }
                });
                e.preventDefault();
            });
        });
    </script>
</body>

</html>