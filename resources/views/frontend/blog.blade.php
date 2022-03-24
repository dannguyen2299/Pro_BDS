@extends('frontend.master.master')
@section('title','Blog')
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
                    <!-- <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> Blog standard</li> -->
                </ul>
            </div>
        </section>
        <!--/blog-post-->
        <section class="bds-blogpost-content py-5">
            <div class="container py-lg-4 py-md-3 py-2">
                <div class="row mt-md-5">
                    <div class="col-lg-8 bds-news">
                        <div class="row" id="new_estate">
                           
                        </div>
                        <!-- pagination -->
                        <div class="pagination-wrapper mt-5 pt-lg-3 text-center">
                            <ul class="page-pagination">
                                <li><span aria-current="page" class="page-numbers current">1</span></li>
                                <li><a class="page-numbers" href="#url">2</a></li>
                                <li><a class="page-numbers" href="#url">3</a></li>
                                <li><a class="page-numbers" href="#url">...</a></li>
                                <li><a class="page-numbers" href="#url">15</a></li>
                                <li><a class="next" href="#url">Next <span class="fa fa-angle-right"></span></a></li>
                            </ul>
                        </div>
                        <!-- //pagination -->
                    </div>
                    <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
                        <aside class="sidebar" id="new_relate">
                           
                            <!-- sidebar sticky -->
                            <div class="sidebar-sticky">
                                <div class="sidebar-sticky-fix">
                                   

                                </div>
                            </div>
                            <!-- //sidebar sticky -->

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
                    url:'/tin_tuc',
                    success:function(result){
                        
                        console.log(result);
                        var str="";
                        if(result.tintuc.data.length==0){
                            str+="Đang cập nhật...";
                        }
                        else{
                            for(var i=0;i<result.tintuc.data.length;i++){
                                var dateNew=new Date(result.tintuc.data[i].ThoiGianTaoTT);
                                
                                str+="<div class='col-md-6 mt-md-0 mt-sm-4 mb-5'>";
                                    str+="<div class='grids5-info'>";
                                        str+="<span class='posted-date'>";
                                            str+="<a href='../"+result.tintuc.data[i].idTinTuc+"/"+result.tintuc.data[i].TieuDeTinTuc_Slug+".html'>";
                                                str+="<span class='small'>"+dateNew.getFullYear()+"</span>";
                                                str+="<span class='big'>"+dateNew.getUTCDate()+"</span>";
                                                str+="<span class='small'>Tháng "+(dateNew.getUTCMonth() + 1)+"</span>";
                                            str+="</a>";
                                        str+="</span>";
                                    str+="<a href='../"+result.tintuc.data[i].idTinTuc+"/"+result.tintuc.data[i].TieuDeTinTuc_Slug+".html' class='d-block zoom'><img src='../backend/dist/img/"+result.tintuc.data[i].AnhDaiDien+"' alt='' class='img-fluid news-image' /></a>";
                                        str+="<div class='blog-info'>";
                                            // str+="<a href='#category' class='category'>Tin tức 1</a>";
                                            str+="<h4><a class='title_estate' title='"+result.tintuc.data[i].TieuDeTinTuc+"' href='../"+result.tintuc.data[i].idTinTuc+"/"+result.tintuc.data[i].TieuDeTinTuc_Slug+".html'>"+result.tintuc.data[i].TieuDeTinTuc+"</a></h4>";
                                            str+="<p class='title_estate'>"+result.tintuc.data[i].MoTaTinTuc+"</p>";
                                        str+="</div>";
                                    str+="</div>";
                            str+="</div>";

                            }
                        }

                        $("#new_estate").html(str);
                    }
                })
            });
        </script>
<script>
    $(document).ready(function(){
        $.ajax({
            type:'post',
            url:'/new_relate',
            success:function(result){
                console.log(result);
                var str="";
                str+="<div class='sidebar-widget sidebar-blog-category'>";
                    str+="<div class='sidebar-title'>";
                        str+="<h4>Tìm kiếm tin tức</h4>";
                    str+="</div>";
                        str+="<form action='#' class='search-box' method='post'>";
                            str+="<div class='form-group'>";
                                str+="<input type='search' name='search' placeholder='Search...' required=''>";
                                str+="<button><span class='fa fa-search'></span></button>";
                            str+="</div>";
                        str+="</form>";
                    str+="</div>";
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