<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>
    <base href="{{ asset('').'frontend/' }}">
    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Template CSS -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <link rel="stylesheet" href="assets/css/style-liberty.css">
    <link rel="stylesheet" href="assets/css/site.css">
    <link rel="stylesheet" href="../backend/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../backend/assets/css/dropzone.css">
    <link rel="stylesheet" href="../backend/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script src="../backend/plugins/jquery/jquery.min.js"></script>
    <script src="assets/js/jquery.formatCurrency-1.4.0.min.js"></script>
    <script src="assets/js/simple.money.format.js"></script>
    <script src="../backend/assets/js/dropzone.js"></script>
    <script src="assets/js/rangeslider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
    	.dropzoneDragArea {
		    background-color: #fbfdff;
		    border: 1px dashed #c0ccda;
		    border-radius: 6px;
		    padding: 60px;
		    text-align: center;
		    margin-bottom: 15px;
		    cursor: pointer;
		}
		.dropzone{
			box-shadow: 0px 2px 20px 0px #f2f2f2;
			border-radius: 10px;
		}
    </style>
</head>

<body>

    <!--header-->
    <header id="site-header" class="fixed-top">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg stroke px-0">
                <h1>
                    <a class="navbar-brand" href="../">
                        <span class="fa fa-home"></span> BDS
                    </a>
                </h1>
                <!-- if logo is image enable this   
<a class="navbar-brand" href="#index.html">
  <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
</a> -->
    <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
          <span class="navbar-toggler-icon fa icon-close fa-times"></span>
    </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-lg-5 mr-auto" id="show_category">
                    
                        
                    </ul>
                    <div class="top-quote mt-lg-0" >

                        @hasrole((['Admin','Nhân viên','Khách hàng']))
                        <ul class="navbar-nav ml-lg-5 mr-auto" style="float: left;padding-right: 110px">
                            <li class="nav-item dropdown @@pages__active">
                                <a class="nav-link dropdown-toggle" style="width: 30px;" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/images/PngItem_786293.png" alt="" style="width: 40px;">
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item @@about__active">{{ Auth::user()->Ten }}</a>
                                    <a class="dropdown-item @@team__active" href="../danh-sach-tin-dang">Quản lý tin đăng</a>
                                    <a class="dropdown-item @@team-single__active" href="../dang-tin">Đăng tin</a>
                                    <a class="dropdown-item @@team-single__active" href="../trang-ca-nhan">Thông tin cá nhân</a>
                                    <a class="dropdown-item @@team-single__active" href="../logout">Đăng xuất</a>
                                    @hasrole((['Admin','Nhân viên']))
                                    <a class="dropdown-item @@team-single__active" href="../admin">Admin Page</a>
                                    @endhasrole
                                </div>
                            </li>
                        </ul>

                    @else
                        
                        <a href="../dang-ky" class="btn btn-primary mr-1"> Đăng ký</a>
                        <a href="../dang-nhap" class="btn btn-primary mr-1"> Đăng nhập</a>      
                        <a href="../dang-tin" class="btn btn-style btn-primary"> Đăng tin</a>
                    @endhasrole
                    </div>
                    <!--/search-right-->
                    {{-- <div class="search mx-3">
                        <input class="search_box" type="checkbox" id="search_box">
                        <label class="fa fa-search" for="search_box"></label>
                        <div class="search_form">
                            <form action="error.html" method="GET">
                                <input type="text" placeholder="Search"><input type="submit" value="search">
                            </form>
                        </div>
                    </div> --}}
                    <!--//search-right-->
                </div>

              
            </nav>
        </div>
    </header>
    <!--/header-->




    @yield('content')



     <!-- footers 20 -->
     <section class="bds-footers-20">
        <div class="footers20">
            <div class="container">
                <div class="footers20-content">
                    <div class="d-grid grid-col-4 grids-content">
                        <div class="column">
                            <a href="#url" class="link"><span class="fa fa-comments"></span></a>
                            <a href="#url" class="title-small">Tư vấn miễn phí</a>
                            <h4>Đặt lịch tư vấn miễn phí</h4>
                            <a href="#buytheme" class="btn btn-style btn-primary"> Tư vấn miễn phí
              <span class="fa fa-long-arrow-right ml-2"></span> </a>
                        </div>
                        <div class="column">
                            <a href="#url" class="link"><span class="fa fa-phone"></span></a>
                            <a href="#url" class="title-small">Hotline</a>
                            <h4>Gọi ngay</h4>
                            <a href="tel:0123456789">
                                <p class="contact-phone mt-2"><span class="lnr lnr-phone-handset"></span> 0123456789
                                </p>
                            </a>
                        </div>
                        <div class="column mt-lg-0 mt-md-5">
                            <h4 class="mb-1">Nhận tin tức bđs qua email</h4>
                            <!-- <p>and get latest news and updates</p> -->
                            <form action="#" class="subscribe-form mt-4" method="post">
                                <div class="form-group">
                                    <input type="email" name="subscribe" placeholder="Enter your email" required="">
                                    <button class="btn btn-style btn-primary">Subscribe</button>
                                </div>
                            </form>
                            <ul class="footers-17_social">
                                <h4 class="d-inline mr-4">Follow us</h4>
                                <li><a href="#url" class="twitter"><span class="fa fa-twitter"></span></a></li>
                                <li><a href="#url" class="facebook"><span class="fa fa-facebook"></span></a></li>
                                <li><a href="#url" class="linkedin"><span class="fa fa-linkedin"></span></a></li>
                                <li><a href="#url" class="instagram"><span class="fa fa-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-grid grid-col-3 grids-content1 bottom-border">
                        <div class="columns copyright-grid align-self">
                            <p class="copy-footer-29"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="Go to top">
    &#10548;
  </button>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("movetop").style.display = "block";
                } else {
                    document.getElementById("movetop").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
        <!-- /move top -->
    </section>

    <!-- jQuery and Bootstrap JS -->
    {{-- <script src="assets/js/jquery-3.3.1.min.js"></script> --}}
    <script src="assets/js/bootstrap.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="../backend/plugins/select2/js/select2.full.min.js"></script>
    <script src="../backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>

    {{-- <script src="assets/js/theme-change.js"></script> --}}
    <!-- theme switch js (light and dark)-->

    <!-- stats number counter-->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    {{-- <script src="assets/js/jquery.countup.js"></script> --}}

    <script src="../backend/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        function changeImg(input){
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		    if(input.files && input.files[0]){
		        var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#avatar').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}

        function changeImgBank(input){
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		    if(input.files && input.files[0]){
		        var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#img_transfer').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
        $(function() {
            // bsCustomFileInput.init();

            $('.select2').select2();

            $('#summernote').summernote();
            $('#avatar').click(function(){
		        $('#select_file').click();
		    });

            $('#img_transfer').click(function(){
		        $('#select_file_bank').click();
		    });
        });

 
    </script>
    <script>
        // $('.counter').countUp();
    </script>
    <!-- //stats number counter -->
    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    
    </script>
    <!-- owlcarousel -->
    <script src="assets/js/owl.carousel.js"></script>
    <!-- script for blog post slider -->
    <script>
        $(document).ready(function() {
            $('.owl-blog').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                responsiveClass: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    480: {
                        items: 1,
                        nav: true
                    },
                    700: {
                        items: 1,
                        nav: true
                    },
                    1090: {
                        items: 1,
                        nav: true,
                        
                    }
                }
            })
        })
    </script>
    

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function() {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function() {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function() {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- bootstrap -->

    <div id="v-w3layouts"></div>

<script>
    $(document).ready(function(){
        
        $.ajax({
            type:'post',
            url:'/danh_muc',
            success:function(result){
                var str="";
                
                for(var i=0;i<result.danhmuccha.length;i++){
                    
                    str+="<li class='nav-item' id='drop_down'>";
                    str+="<a class='nav-link dropdown-toggle' href='../";
                    if(result.danhmuccha[i].TieuDeDanhMuc_Slug=="tin-tuc"){
                        str+="tin-tuc";
                    }
                    else{
                        str+=result.danhmuccha[i].TieuDeDanhMuc_Slug+".html";
                    }
                    // +result.danhmuccha[i].TieuDeDanhMuc_Slug+
                    //  str+=".html'";
                    str+="'>"+result.danhmuccha[i].TieuDeDanhMuc;      
                    if(result.arr[result.danhmuccha[i].idDanhMuc]>0){
                        str+="<span class='fa fa-angle-down'></span></a>";
                        str+="<div class='dropdown-menu' id='drop' aria-labelledby='navbarDropdown"+result.danhmuccha[i].idDanhMuc+"'>";

                        for(var j=0;j<result.danhmuccon.length;j++){
                            if(result.danhmuccha[i].idDanhMuc===result.danhmuccon[j].idDanhMucCha){       
                                str+="<a class='dropdown-item @@about__active' href='../"+result.danhmuccon[j].TieuDeDanhMuc_Slug+".html'>"+result.danhmuccon[j].TieuDeDanhMuc+"</a>";           
                            }  
                        }
                            str+="</div>";
                    }       
                }
                 $("#show_category").html(str);
            }  
        });
    });
</script>

</body>

</html>