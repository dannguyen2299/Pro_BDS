@extends('backend.master.master')
@section('title','Them tin tuc')
@section('content')
<script>
  function to_slug() {
      var txt_tieude, tieude_slug;
      txt_tieude = $("#txt_tieude").val();
      // Chuyển hết sang chữ thường
      tieude_slug = txt_tieude.toLowerCase();

      // xóa dấu
      tieude_slug = tieude_slug.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
      tieude_slug = tieude_slug.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
      tieude_slug = tieude_slug.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
      tieude_slug = tieude_slug.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
      tieude_slug = tieude_slug.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
      tieude_slug = tieude_slug.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
      tieude_slug = tieude_slug.replace(/(đ)/g, 'd');

      // Xóa ký tự đặc biệt
      tieude_slug = tieude_slug.replace(/([^0-9a-z-\s])/g, '');

      // Xóa khoảng trắng thay bằng ký tự -
      tieude_slug = tieude_slug.replace(/(\s+)/g, '-');

      // xóa phần dự - ở đầu
      tieude_slug = tieude_slug.replace(/^-+/g, '');

      // xóa phần dư - ở cuối
      tieude_slug = tieude_slug.replace(/-+$/g, '');

      // return
      //$("#txt_slug_category").val() = txt_slug_category;
      document.getElementById('txt_tieude_slug').value = tieude_slug;
  }
</script>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Thêm Tin Tức</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thêm tin tức</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thêm tin tức</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                @csrf
                                <div>
                                    <form id="frm_add_new" method="post" enctype="multipart/form-data" role="form" data-route="{{ route('addNews') }}">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="txt_tieude">Tiêu đề</label>
                                            <input type="text" class="form-control" id="txt_tieude" name="txt_tieude" placeholder="Tiêu đề tin tức..." onkeyup="to_slug();">
                                            <div id="show_error"></div>
                                          </div>
                                            <input type="hidden" name="txt_tieude_slug" id="txt_tieude_slug" />
                                        <div class="form-group">
                                            <label for="txt_mota">Mô tả</label>
                                            <input type="text" class="form-control" id="txt_mota" name="txt_mota" placeholder="Mô tả...">
                                            <div id="show_error1"></div>
                                          </div>

                                        <div class="form-group">
                                            <label>Danh mục</label>
                                            <select class="select2" multiple="multiple" data-placeholder="Chọn danh mục..." name="txt_danhmuc[]" id="txt_danhmuc" style="width: 100%;">
                                              {{ GetCategory($category,-1,"",0) }}
                                             
                                            </select>
                                            <div id="show_error2"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Ảnh đại diện</label>
                                            <div>
                                              <input id="select_file" type="file" name="select_file" class="form-control hidden" style="display: none;"
                                                onchange="changeImg(this)">
                                            <img id="avatar" class="thumbnail" width="200px" height="150px" src="dist/img/import-img.png" style="cursor: pointer;border-style:groove;">
                                            </div>
                                            <div id="show_error3"></div>
                                            
    
                                        </div>

                                        


                                        <div class="form-group">
                                            <label>Nội dung</label>
                                            <!-- <div class="card-body"> -->
                                            <textarea id="summernote" class="txt_noidung" name="txt_noidung"></textarea>
                                            <div id="show_error4"></div>

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Them moi">
                                    </div>
                                </form>
                                </div>
                              
                            </div>
                          

                        </div>
                      
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
<script>
  // $(document).ready(function(){
  //   var str="";
  //   $.ajax({
  //     url:'/get-category',
  //     type:'post',
  //     processData:false,
  //     contentType:false,
  //     cache:false,
  //     success:function(result){
  //         for(var i=0;i<result.danhmuc.length;i++){
  //           str+="<option value='"+result.danhmuc[i].id+"'>"+result.danhmuc[i].TieuDe+"</option>";
  //         }
  //       $("#txt_danhmuc").html(str);
  //     }
      
  //   })
  // });

  $(function(){
    $("#frm_add_new").submit(function(e){
       
      $('.alert').remove();
      $.ajax({
        type:'post',
        url:"{{ route('addNews') }}",
        //data:form.serialize(),
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        processData: false,
        cache:false,
        
        success:function(result){
          console.log(result);
          for(var i=0;i<result.length;i++){
              if(result[i].txt_tieude){
                $("#show_error").append('<p class="alert alert-danger">'+result[i].txt_tieude+'</p>');

              }
              if(result[i].txt_mota){
                $("#show_error1").append('<p class="alert alert-danger">'+result[i].txt_mota+'</p>');

              }
              if(result[i].txt_danhmuc){
                $("#show_error2").append('<p class="alert alert-danger">'+result[i].txt_danhmuc+'</p>');

              }
              if(result[i].select_file){
                $("#show_error3").append('<p class="alert alert-danger">'+result[i].select_file+'</p>');

              }
              if(result[i].txt_noidung){
                $("#show_error4").append('<p class="alert alert-danger">'+result[i].txt_noidung+'</p>');

              }

              if(result[i].success){
                toastr.success(result[i].success,'Thong bao');
                window.location.href='/admin/list-news';
              }
          }
        }
      });
      e.preventDefault();
    });
  });
</script>

     @endsection