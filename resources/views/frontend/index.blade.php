@extends('frontend.master.master')
@section('title','Home')
@section('content')
<style>
    .select2-container{
        height:45px !important;
    }
    .select2-selection{
        height:45px !important;
    }
    .select2-selection__rendered{
        line-height:45px !important;
    }
    .select2-selection__arrow{
        height:45px !important;
    }
</style>
    <section class="bds-cover-3">
        <div class="cover top-bottom">
            <div class="container">
                <div class="middle-section text-center">
                    <div class="section-width">
                        <p>Hello</p>
                        <h2>Bạn muốn tìm gì?</h2>
                        {{-- <div class="most-searches">
                            <h4>Most Searches</h4>
                            <ul>
                                <li><a href="#link">Villa</a></li>
                                <li><a href="#link">Apartment</a></li>
                                <li><a href="#link">Private house</a></li>
                            </ul> 
                        </div> --}}
                        <input type="hidden" class="id_bds" name="id_bds" id="id_bds">
                        <form action="{{ route('filterEstate') }}" class="bds-cover-3-gd" method="GET">
                            

                                <span class="input-group-btn mt-3 mb-3 mr-2">
                                    <select class="btn btn-default bds_filter select2 category parent_cate" name="form" id="txt_hinhthuc" >
                                        <option value="0">---Hình thức---</option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->idDanhMuc }}">{{ $row->TieuDeDanhMuc }}</option>
                                        @endforeach
                                        
                                    </select>
                                </span>
                                <span class="input-group-btn mt-3 mb-3 mr-2">
                                    <select class="btn btn-default bds_filter select2 kind" name="type" id="txt_loaibds" >
                                        <option value="0">---Loại---</option>
                                    </select>
                                </span>
                                <span class="input-group-btn mt-3 mb-3 mr-2">
                                    <select class="btn btn-default bds_filter select2 choose city" name="province" id="txt_tinhthanh" >
                                        <option value="">---Tỉnh/Thành---</option>
                                        @foreach ($city as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option> 
                                        @endforeach
                                        
                                    </select>
                                </span>
                                <span class="input-group-btn mt-3 mb-3 mr-2">
                                    <select class="btn btn-default bds_filter select2 choose districts" name="district" id="txt_quanhuyen" >
                                        <option value="0">---Quận/Huyện---</option>
                                    </select>
                                </span>
                                <span class="input-group-btn mr-2">
                                    <select class="btn btn-default bds_filter select2 wards" name="ward" id="txt_phuongxa" >
                                        <option value="0">---Phường/Xã---</option>
                                    </select>
                                </span>
                            
                                <span class="input-group-btn mr-2">
                                    <select class="btn btn-default bds_filter" name="bedroom" >
                                        <option value="" selected="">Số phòng ngủ</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                        <option value="6">6+</option>
                                        <option value="7">7+</option>
                                        <option value="8">8+</option>
                                        
                                    </select>
                                </span>
                              
                                <span class="input-group-btn mr-2">
                                    <select class="btn btn-default bds_filter" name="floor" >
                                        <option value="" selected="">Số tầng</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                        <option value="6">6+</option>
                                        <option value="7">7+</option>
                                        <option value="8">8+</option>
                                        
                                    </select>
                                </span>
                                
                                <button type="submit" style="width:23.5%;height:45px" class="btn-primary">Search</button>
                        </form>
                    </div>
                    <section id="bottom" class="demo">
                        <a><span></span>Scroll</a>
                    </section>
                </div>
            </div>
        </div>
    </section>

    
    <section class="locations-1" id="locations">
        <div class="locations py-5">
            <div class="container py-lg-5 py-md-4 py-2" id="featured_estate">
                <div class="heading text-center mx-auto" >
                    <h3 class="title-big">Nhà đất cho thuê mới nhất</h3>
                </div>
                <div class="row pt-md-5 pt-4" >
                    
                </div>
                <a href="http://" class="pull-right">View more >></a>

            </div>
        </div>
    </section>

    <section class="locations-1 popular">
        <div class="locations py-5">
            <div class="container py-lg-5 py-md-4">
                <div class="heading text-center mx-auto">
                    <!-- <h6 class="title-small">Explore cities</h6> -->
                    <h3 class="title-big">Khu vực</h3>
                </div>
                <div class="row pt-5" id="location_estate">
                   

                </div>
            </div>
        </div>
    </section>
    
    <div class="bds-news" id="news">
        <section id="grids5-block" class="py-5">
            <div class="container py-lg-5 py-md-4 py-2" id="location_new">
                
            </div>
        </section>
    </div>
    <!--  //News section -->
    <section class="bds-companies-hny-6 py-5">
        <!-- /grids -->
        <div class="container py-md-3">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 column">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client1.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client2.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-md-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client3.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client4.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client5.png" alt="client"> </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 column mt-lg-0 mt-4">
                    <div class="company-gd">
                        <a href="#client"><img class="img-responsive" src="assets/images/client6.png" alt="client"> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- //grids -->
    </section>
    
    <script>
        $(document).ready(function(){

            var formatter = new Intl.NumberFormat({
            style: 'currency',
            currency: 'VND',
        });
            $.ajax({
                type:'post',
                url:'/featured_estate',
                success:function(result){
                    console.log(result);
                    var str="";
                    if(result.batdongsan.data.length==0){
                        str+="<div class='heading text-center mx-auto' >";
                        str+="<h3 class='title-big'>Nhà đất cho thuê mới nhất</h3>";
                        str+="</div>";
                        str+="<div class='row pt-md-5 pt-4' >";
                            str+="Đang cập nhật...";
                        str+="</div>";
                    }
                    else{
                        str+="<div class='heading text-center mx-auto' >";
                        str+="<h3 class='title-big'>Nhà đất cho thuê mới nhất</h3>";
                        str+="</div>";
                        str+="<div class='row pt-md-5 pt-4' >";
                        for(var i=0;i<result.batdongsan.data.length;i++){
                            var dateNew=new Date(result.batdongsan.data[i].ThoiGianTaoBDS);
                            str+="<div class='col-lg-3 col-md-6 listing-img mb-5'>";
                            str+="<a href='../"+dateNew.getFullYear()+(dateNew.getUTCMonth()+1)+(dateNew.getUTCDate()+1)+"/"+result.batdongsan.data[i].idBDS+"/"+result.batdongsan.data[i].TieuDeBDS_Slug+"'>";
                            str+="<div class='box16'>";
                                str+="<div class='rentext-listing-category'><span>Hot</span><span>New</span></div>";
                                str+="<img class='img-fluid avatar_image' src='../image/avatar/estate/"+result.batdongsan.data[i].AnhDaiDien+"' alt=''>";
                                str+="<div class='box-content'>";
                                    str+="<h3 class='title'>"+(result.batdongsan.data[i].GiaTienBDS_JS)+" </h3>";
                                str+="</div>";
                            str+="</div>";
                        str+="</a>";
                        str+="<div class='listing-details blog-details align-self'>";
                            str+="<h4 class='user_title agent'>";
                                str+="<a class='title_estate' href='#url' title='"+result.batdongsan.data[i].TieuDeBDS+"'>"+result.batdongsan.data[i].TieuDeBDS+"</a>";
                            str+="</h4>";
                            str+="<i class='fa fa-map-marker'> "+result.batdongsan.data[i].name+"</i>";
                            str+="<ul class='mt-3 estate-info'>";
                                // str+="<li><span class='fa fa-bed'></span> 1 Bed</li>";
                                // str+="<li><span class='fa fa-shower'></span> 2 Baths</li>";
                                str+="<li><span class='fa fa-share-square-o'></span> "+result.batdongsan.data[i].DienTich+" (M²)</li>";
                            str+="</ul>";
                            str+="<div class='author' style='display:flex;'>";
                                str+="<p class='date_estate'><span class='fa fa-clock-o'></span> "+dateNew.getUTCDate()+"-"+(dateNew.getUTCMonth() + 1)+"-"+dateNew.getFullYear()+ "</p>";
                                // str+="<a href='#more' class='more' style='font-size:15px'>Xem chi tiết <span class='fa fa-long-arrow-right'></span> </a>";

                            str+="</div>";
                        str+="</div>";
                    str+="</div>";

                        }
                        str+="</div>";
                        str+="<a href='../nha-dat-cho-thue.html' class='pull-right'>View more >></a>";
                    }

                    $("#featured_estate").html(str);
                }
            })
        });
    </script>
    <script>
        $(document).ready(function(){
            $.ajax({
                    type:'post',
                    url:'/featured_estate',
                    success:function(result){
                        console.log(result);
                        var str="";
                        if(result.tintuc.data.length==0){
                            str+="<h3 class='title-big text-center'>Tin tức nổi bật</h3>";
                            str+="<div class='row mt-lg-5 mt-4 pt-3'>";
                                str+="Đang cập nhật...";
                            str+="</div>";
                        }
                        else{
                            str+="<h3 class='title-big text-center'>Tin tức nổi bật</h3>";
                            str+="<div class='row mt-lg-5 mt-4 pt-3'>";
                            for(var i=0;i<result.tintuc.data.length;i++){
                                var dateNew=new Date(result.tintuc.data[i].ThoiGianTaoTT);
                                

                                str+="<div class='col-lg-3 col-md-6 mt-md-0 mt-sm-4 mb-5'>";
                                    str+="<div class='grids5-info'>";
                                        str+="<span class='posted-date'>";
                                            str+="<a href='#blog-single'>";
                                                str+="<span class='small'>"+dateNew.getFullYear()+"</span>";
                                                str+="<span class='big'>"+dateNew.getUTCDate()+"</span>";
                                                str+="<span class='small'>Tháng "+(dateNew.getUTCMonth() + 1)+"</span>";
                                            str+="</a>";
                                        str+="</span>";
                                    str+="<a href='../"+result.tintuc.data[i].idTinTuc+"/"+result.tintuc.data[i].TieuDeTinTuc_Slug+".html' class='d-block zoom'><img src='../backend/dist/img/"+result.tintuc.data[i].AnhDaiDien+"' alt='' class='img-fluid news-image avatar_image' /></a>";
                                        str+="<div class='blog-info'>";
                                            str+="<h4><a class='title_estate' title='"+result.tintuc.data[i].TieuDeTinTuc+"' href='../"+result.tintuc.data[i].idTinTuc+"/"+result.tintuc.data[i].TieuDeTinTuc_Slug+".html'>"+result.tintuc.data[i].TieuDeTinTuc+"</a></h4>";
                                            str+="<p class='title_estate'>"+result.tintuc.data[i].MoTaTinTuc+"</p>";
                                        str+="</div>";
                                    str+="</div>";
                            str+="</div>";

                            }
                            str+="</div>";
                            str+="<a href='../tin-tuc' class='pull-right'>View more >></a>";
                        }

                        $("#location_new").html(str);
                    }
                })
        });
    </script>
    <script>
        $(document).ready(function(){
            $.ajax({
                type:'post',
                url:'/featured_estate',
                success:function(result){
                    var str="";
                    if(result.count.data.length==0){
                        str+="Đang cập nhật...";
                    }
                    else{
                        for(var i=0;i<result.count.data.length;i++){
                            str+="<div class='col-lg-3 col-md-4 col-6'>";
                        str+="<a href='#url'>";
                            str+="<div class='box16'>";
                                str+="<img class='img-fluid' src='assets/images/thanh-pho-dep-nhat-the-gioi-20.jpg' alt=''>";
                                str+="<div class='box-content'>";
                                    str+="<h3 class='title mb-1'>"+result.array[result.count.data[i].id_TinhThanh][0].name+"</h3>";
                                    str+="<span class='post'>"+result.count.data[i].BDS+" căn</span>";
                                str+="</div>";
                            str+="</div>";
                        str+="</a>";
                    str+="</div>";

                        }
                    }
                    $("#location_estate").html(str);
                }
            });
        })
    </script>
    <script src="../backend/dist/js/select_location.js"></script>
    <script src="../backend/dist/js/select_category.js"></script>
    @endsection