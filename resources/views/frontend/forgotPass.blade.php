@extends('frontend.master.master')
@section('title','Forgot Password')
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
                    <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Forgot password</li>
                </ul>
            </div>
        </section>
        
        <section class="error-page py-5 text-center">
            <div class="container py-md-5 py-sm-4">
                
                <div class="main-cover w3">
                    <form action="{{ url('/recover-pass') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="txt_email">Nhập lại email đã đăng ký của bạn:</label>
                            @if(session()->has('err'))
                            <div class="alert alert-danger">
                                {!! session()->get('err') !!}
                            </div>
                            @elseif(session()->has('message'))
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                            @endif
                            <input type="email" class="form-control" id="email_account" name="email_account" placeholder="Email...">
                            {{-- <div id="show_error"></div> --}}
                        </div>
                        <button type="submit" id="btn_add_dm" class="btn btn-primary" style="float: right;">Gửi đi</button>

                    </form>
                </div>
            </div>
        </section>
        
@endsection