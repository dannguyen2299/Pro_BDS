@extends('frontend.master.master')
@section('title','Property Single')
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
                <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span>Chi tiết tin đăng</li>
                <!-- <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span> property single</li> -->
            </ul>
        </div>
    </section>
    <!--/blog-post-->
    <section class="bds-blog post-content py-5">
        <div class="container py-lg-4 py-md-3 py-2">
            <div class="inner mb-4">
                <ul class="blog-single-author-date align-items-center">
                    <!-- <li>
                        <div class="listing-category"><span>Buy</span><span>Rent</span></div>
                    </li> -->
                    <li><span class="fa fa-clock-o"></span> {{ $days }}</li>
                    <li><span class="fa fa-eye"></span> {{ $batdongsan->ViewBDS==null ? '0' : $batdongsan->ViewBDS }} views</li>
                </ul>
            </div>
            <div class="post-content">
                <h2 class="title-single">{{ $batdongsan->TieuDeBDS }}</h2>
            </div>
            <div class="blo-singl mb-4">
                <ul class="blog-single-author-date align-items-center">
                    {{-- <li>
                        <p>Địa chỉ</p>
                    </li> --}}
                    <li><span class="fa fa-map-marker"></span> {{ $batdongsan->DiaChiBDS }}</li>
                    {{-- <li><span class="fa fa-bath"></span> 4 Baths</li>
                    <li><span class="fa fa-share-square-o"></span> 1258 sqrft</li> --}}
                </ul>
                <ul class="share-post">
                    <a href="#url" class="cost-estate m-o">Giá: {{ $batdongsan->GiaTienBDS_JS }}</a>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-8 bds-news">
                    <div class="blog-single-post">
                        <div class="single-post-image mb-5">
                            <div class="owl-blog owl-carousel owl-theme">
                                @forelse ($hinhanh as $row)
                                    <div class="item">
                                        <div class="card">
                                            <img src="../image/estates/{{ $row->TenAnh }}" class="img-fluid radius-image" style="height: 500px" alt="image">
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                               
                            </div>
                        </div>

                        <div class="single-post-content">
                            <h3 class="post-content-title mb-3">Mô tả</h3>
                            <p class="mb-4">
                                {!! nl2br($batdongsan->MoTaBDS) !!}
                            </p>
                            <div class="single-bg-white">
                                <h3 class="post-content-title mb-4">Chi tiết</h3>
                                <ul class="details-list">
                                    <li><strong>Mã tin :</strong> {{ $batdongsan->idBDS }} </li>
                                    <li><strong>Diện tích :</strong> {{ $batdongsan->DienTich }}(m²)</li>
                                    @if ($batdongsan->SoTang!=0)
                                        <li><strong>Số tầng :</strong> {{ $batdongsan->SoTang }} </li>
                                    @else
                                    @endif
                                    @if ($batdongsan->SoPhongNgu!=0)
                                        <li><strong>Số phòng ngủ :</strong> {{ $batdongsan->SoPhongNgu }} </li>
                                    @else
                                    @endif
                                    @if ($batdongsan->SoToilet!=0)
                                        <li><strong>Số Toilet :</strong> {{ $batdongsan->SoToilet }} </li>
                                    @else   
                                    @endif
                                    @if ($batdongsan->MatTien!=0)
                                        <li><strong>Mặt tiền :</strong> {{ $batdongsan->MatTien }} </li>
                                    @else  
                                    @endif
                                    @if ($batdongsan->DuongVao!=0)
                                        <li><strong>Đường vào :</strong> {{ $batdongsan->DuongVao }} </li>
                                    @else            
                                    @endif
                                    <li><strong>Hướng nhà :</strong> {{ $batdongsan->HuongNha }} </li>
                                    <li><strong>Hướng ban công :</strong> {{ $batdongsan->HuongBanCong }} </li>
                                    @if ($batdongsan->ThongTinPhapLy!=0)
                                        <li><strong>Thông tin pháp lý :</strong> {{ $batdongsan->ThongTinPhapLy }} </li>
                                    @else 
                                    @endif
                                    
                                </ul>
                            </div>
                            @if ($batdongsan->NoiThat!=null)
                                <div class="single-bg-white">
                                    <h3 class="post-content-title mb-4">Nội thất</h3>
                                    <p class="mb-4">
                                        {!! nl2br($batdongsan->NoiThat) !!}
                                    </p>
                                </div>
                            @else
                                
                            @endif
                            
                        </div>

                        {{-- <div class="single-bg-white">
                            <h3 class="post-content-title mb-4">Khu vực</h3>
                            <div class="agent-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.2895687731!2d-74.26055986835598!3d40.697668402590374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1562582305883!5m2!1sen!2sin"
                                    frameborder="0" style="border:0" allowfullscreen=""></iframe>
                            </div>
                        </div> --}}

                        <!-- <div class="single-bg-white mb-0">
                            <h3 class="post-content-title mb-4">Video</h3>
                            <div class="post-content">
                                <iframe src="https://www.youtube.com/embed/jqP3m3ElcxA" frameborder="0" allowfullscreen=""></iframe>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
                    <aside class="sidebar">

                        <!-- Popular Post Widget-->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Liên hệ</h4>
                            </div>

                            <article class="post">
                                <figure class="post-thumb"><img src="../image/avatar/users/avatar.jpg" class="radius-image" alt="">
                                </figure>
                                <div class="text mb-0"><a>{{ $batdongsan->TenLienHe }}
                                </a>
                                <div class="post-info"><span class="fa fa-map-marker"></span> {{ $batdongsan->DiaChiLienHe }}</div>
                                    <div class="post-info"><span class="fa fa-phone"></span> {{ $batdongsan->DienThoai }}</div>
                                    <div class="post-info"><span class="fa fa-envelope"></span> {{ $batdongsan->emailUser }}</div>
                                </div>
                            </article>
                            <!-- <button type="submit" class="btn btn-primary btn-style w-100">Request details</button> -->
                        </div>


                        <!-- Popular Post Widget-->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Tin liên quan</h4>
                            </div>

                            <article class="post">
                                <figure class="post-thumb"><img src="assets/images/l1.jpg" class="radius-image" alt="">
                                </figure>
                                <div class="text"><a href="#blog-single">Tiêu đề
                                </a>
                                    <div class="post-info">Sep 09, 2020</div>
                                </div>
                            </article>
                            <article class="post">
                                <figure class="post-thumb"><img src="assets/images/l1.jpg" class="radius-image" alt="">
                                </figure>
                                <div class="text"><a href="#blog-single">Tiêu đề
                                </a>
                                    <div class="post-info">Sep 09, 2020</div>
                                </div>
                            </article>
                            <article class="post">
                                <figure class="post-thumb"><img src="assets/images/l1.jpg" class="radius-image" alt="">
                                </figure>
                                <div class="text"><a href="#blog-single">Tiêu đề
                                </a>
                                    <div class="post-info">Sep 09, 2020</div>
                                </div>
                            </article>

                        </div>

                        <!-- sidebar sticky -->
                        <div class="sidebar-sticky">
                            <div class="sidebar-sticky-fix">
                                <!-- Tags Widget-->
                                <!-- <div class="sidebar-widget popular-tags">
                                    <div class="sidebar-title">
                                        <h4>Tags</h4>
                                    </div>
                                    <a href="#url">Listing</a>
                                    <a href="#url">Property</a>
                                    <a href="#url">Rent</a>
                                    <a href="#url">Sale</a>
                                    <a href="#url">Estate</a>
                                    <a href="#url">Villa</a>
                                    <a href="#url">Home</a>
                                </div> -->

                            </div>
                        </div>
                        <!-- //sidebar sticky -->

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!--//blog-posts-->
  @endsection