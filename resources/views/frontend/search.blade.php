@extends('frontend.master.master')
@section('title','Search')
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
                <li class="active"><span class="fa fa-angle-right mx-2" aria-hidden="true"></span>Tìm kiếm</li>
            </ul>
        </div>
    </section>
    <section class="locations-1" id="locations">
        <div class="locations py-5">
            <div class="container py-lg-5 py-md-4 py-2">
                <div class="row">
                    @forelse ($batdongsan as $row)
                        <div class="col-lg-3 col-md-6 listing-img mb-5">
                        <a href="../{{ \Carbon\Carbon::parse($row->ThoiGianTaoBDS)->format('Ymd') }}/{{ $row->idBDS }}/{{ $row->TieuDeBDS_Slug }}">
                            <div class="box16">
                                <div class="rentext-listing-category">@if ($row->id_LoaiTin==50000)
                                    <span>Tin nổi bật</span>
                                    {{-- <span>New</span> --}}
                                @endif
                                </div>
                                <img class="img-fluid avatar_image" src="../image/avatar/estate/{{ $row->AnhDaiDien }}" alt="{{ $row->AnhDaiDien }}">
                                <div class="box-content">
                                    <h3 class="title">{{ ($row->GiaTienBDS_JS) }} </h3>
                                            
                                </div>
                            </div>
                        </a>
                        <div class="listing-details blog-details align-self">
                            <h4 class="user_title agent">
                                <a class='title_estate' href="../{{ \Carbon\Carbon::parse($row->ThoiGianTaoBDS)->format('Ymd') }}/{{ $row->idBDS }}/{{ $row->TieuDeBDS_Slug }}">{{ $row->TieuDeBDS }}</a>
                            </h4>
                            <i class="fa fa-map-marker"> {{ $row->name }}</i>
                            <p class="user_position title_estate">{{ $row->MoTaBDS }}</p>
                            <ul class="mt-3 estate-info">
                                {{-- <li><span class="fa fa-bed"></span> 1 Bed</li>
                                <li><span class="fa fa-shower"></span> 2 Baths</li> --}}
                                <li><span class="fa fa-share-square-o"></span> {{ $row->DienTich }} M²</li>
                            </ul>
                            <div class="author " style='display:flex;'>
                                {{-- <p class="date_estate"><span class='fa fa-clock-o'></span></p> --}}
                                {{-- <a href="#more" class="more">Xem chi tiết <span class="fa fa-long-arrow-right"></span> </a> --}}

                            </div>
                        </div>
                    </div>
                    @empty
                        <p>Không tìm thấy kết quả phù hợp</p>
                    @endforelse
                    
                   


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
        </div>
    </section>
   @endsection