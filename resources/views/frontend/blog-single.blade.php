@extends('frontend.master.master')
@section('title','Bất động sản')
@section('content')
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
                    <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Tin tức</li>
                   
                </ul>
            </div>
        </section>
        <!--/blog-post-->
        <section class="bds-blog post-content py-5">
            <div class="container py-lg-5 py-md-3 py-2">
                <div class="row">
                    <div class="col-lg-8 bds-news">
                        <div class="blog-single-post">
                            <div class="post-content">
                                <h2 class="title-single mb-3"> {{ $tintuc->TieuDeTinTuc }}</h2>
                            </div>
                            <div class="blo-singl mb-4">
                                <ul class="blog-single-author-date d-flex align-items-center">
                                    {{-- <li class="circle avatar"><img src="assets/images/team1.jpg" alt="single post image" class="img-fluid"></li>--}}
                                    <li> <span class="fa fa-eye"></span> {{ $tintuc->ViewTinTuc==null ? '0' : $tintuc->ViewTinTuc }} views</li> 
                                    <li><span class="fa fa-calendar"></span> {{ date('d-m-Y', strtotime($tintuc->ThoiGianTaoTT)) }}  ({{ $days }})</li>
                                </ul>
                                <ul class="share-post">
                                    <li class="facebook">
                                        <a href="#link" title="Facebook">
                                            <span class="fa fa-facebook" aria-hidden="true"></span>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="#link" title="Twitter">
                                            <span class="fa fa-twitter" aria-hidden="true"></span>
                                        </a>
                                    </li>
                                    <li class="google">
                                        <a href="#link" title="Google">
                                            <span class="fa fa-google" aria-hidden="true"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Ảnh đại diện -->
                            <div class="single-post-image mb-5">
                                <img src="../backend/dist/img/{{ $tintuc->AnhDaiDien }}" class="img-fluid w-100 radius-image" alt="{{ $tintuc->AnhDaiDien }}">
                            </div>
                            <!-- End  -->
                            <!-- Content  -->
                            <div class="single-post-content">
                               
                               {!! $tintuc->NoiDungTinTuc !!}

                            </div>
                          


                        </div>
                    </div>
                    <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
                        <aside class="sidebar" id="new_relate">

                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!--//blog-posts-->
    <script>
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'/new_relate',
                success:function(result){
                    console.log(result);
                    var str="";
                    if(result.tin_tuc.data.length>0){
                        str+="<div class='sidebar-widget popular-posts'>";
                        str+="<div class='sidebar-title'>";
                            str+="<h4>Tin liên quan</h4>";
                        str+="</div>";
                        str+="<article class='post'>";
                        for(var i=0;i<result.tin_tuc.data.length;i++)
                        {
                            var dateNews=new Date(result.tin_tuc.data[i].ThoiGianTaoTT);
                            
                                str+="<figure class='post-thumb'><img src='../backend/dist/img/"+result.tin_tuc.data[i].AnhDaiDien+"' class='radius-image' alt=''></figure>";
                                    str+="<div class='text'><a class='title_estate' href='../"+result.tin_tuc.data[i].idTinTuc+"/"+result.tin_tuc.data[i].TieuDeTinTuc_Slug+".html'>"+result.tin_tuc.data[i].TieuDeTinTuc+"";
                                str+="</a>";
                                        str+="<div class='post-info'> "+dateNews.getUTCDate()+" Tháng "+(dateNews.getUTCMonth() + 1)+" ,"+dateNews.getFullYear()+"</div>";
                                    str+="</div>";                              
                                   
                        }
                        str+="</article>";
                        str+="</div>";
                    }
                    $("#new_relate").html(str);
                }
            });
        });
    </script>
@endsection