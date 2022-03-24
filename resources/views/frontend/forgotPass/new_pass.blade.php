@extends('frontend.master.master')
@section('title','Reset pasword')
@section('content')
<script>
    $(document).ready(function(){
        $("#frm_reset_pass").validate({
            rules:{
                new_pass:{
                    required:true,
                    minlength:8,
                },
                confirm_new_pass:{
                    required:true,
                    minlength:8,
                    equalTo:"#new_pass",
                },
            },
            messages:{
                new_pass:{
                    required:"*Không được để trống!",
                    minlength:"*Mật khẩu ít nhất 8 ký tự",
                },
                
                confirm_new_pass:{
                    required:"*Không được để trống",
                    minlength:"*Mật khẩu ít nhất 8 ký tự",
                    equalTo:"*Mật khẩu không trùng khớp!",
                },
            },
        });
    });
    
</script>
<style>
    label.error{
        float: left !important;
        font-size: 14px !important;
        color: red !important;
    }
</style>
        <section class="w3l-about-breadcrumb">
            <div class="breadcrumb-bg breadcrumb-bg-about pt-5">
                <div class="container pt-lg-5 py-3">
                </div>
            </div>
        </section>
        <section class="w3l-breadcrumb">
            <div class="container">
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Reset password</li>
                </ul>
            </div>
        </section>
        
        <section class="error-page py-5 text-center">
            <div class="container py-md-5 py-sm-4">
                @php
                    $token=$_GET['token'];
                    $email=$_GET['email'];
                @endphp
                <div class="main-cover w3" style="max-width: 350px !important;">
                    <form action="{{ url('/reset_new_pass') }}" method="post" id="frm_reset_pass">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group form_password mb-4" style="margin-bottom: 2rem !important;" >
                            <label class="pull-left" for="new_pass">Nhập mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Nhập mật khẩu mới...">
                            <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        </div>

                        <div class="form-group form_password" style="margin-bottom: 2rem !important;">
                            <label for="" class="pull-left">Nhập lại mật khẩu mới:</label>
                            <input type="password" class="form-control" id="confirm_new_pass" name="confirm_new_pass" placeholder="Nhập lại mật khẩu mới..."> 
                            <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        </div>
                        <button type="submit" id="btn_add_dm" class="btn btn-primary" style="float: right;">Gửi đi</button>

                    </form>
                </div>
            </div>
        </section>
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
@endsection