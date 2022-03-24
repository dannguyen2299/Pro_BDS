@extends('frontend.master.master')
@section('title','Đăng nhập')
@section('content')

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
                    <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Đăng nhập</li>
                </ul>
            </div>
        </section>
        
        <section class="error-page py-5 text-center">
            <div class="container py-md-5 py-sm-4">
                
                <div class="main-cover w3" style="max-width: 350px !important;">
                    <h1 class="mb-4">ĐĂNG NHẬP</h1>
                    <form method="post" role="form" id="frm_login" data-route="{{ route('login') }}">
                        @if(session()->has('err'))
                            <div class="alert alert-danger">
                                {!! session()->get('err') !!}
                            </div>
                            @elseif(session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                            @endif
                        @csrf
                        
                        <div class="form-group" style="margin-bottom: 2rem !important;">
                            <label for="email" class="pull-left">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email...">
                        <div id="show_error"></div>
                        </div>

                        
                        <div class="form-group form_password" style="margin-bottom: 2rem !important;">
                            <label for="password" class="pull-left">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password...">
                            <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                            <div id="show_error1"></div>
                            <div id="show_error2"></div>
                        </div>
                        <button type="submit" id="btn_add_dm" class="btn btn-primary" style="float: left;">Đăng nhập</button>
                        <a class="pull-right" style="text-decoration: underline !important;" href="../quen-mat-khau">Quên mật khẩu?</a>
                          
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
        <script>
            $(function(){
                $("#frm_login").submit(function(e){
                    var route=$("#frm_login").data('route');
                    var form=$(this);
                    $('.notice').remove();
                    $.ajax({
                        type:'POST',
                        url:route,
                        data:form.serialize(),
                        success:function(result){
                            for(var i=0;i<result.length;i++){
                                if(result[i].email){
                                    $("#show_error").append('<p class="text-danger notice pull-left">'+result[i].email+'</p>');
                                }
                                if(result[i].password){
                                    $("#show_error1").append('<p class="text-danger notice pull-left">'+result[i].password+'</p>');
                                }
    
                                if(result[i].success){
                                     
                                    toastr.success(result[i].success,'Thông báo');
                                    window.location.href='/';
                                    //
    
                                }
                                if(result[i].error){
                                    $("#show_error2").append('<p class="text-danger notice pull-left" style="font-size:14px !important;">'+result[i].error+'</p>');
                                }
                            }
                        }
                    });
                    e.preventDefault();
                })
            });
        </script>
@endsection