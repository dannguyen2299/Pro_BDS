@extends('backend.master.master')
@section('title','Danh sach tin tuc')
@section('content')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Danh sách tin tức</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Danh sách tin tức</li>
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách tin tức</h3>
                                </div>
                                <!-- /.card-header -->
                                <input type="hidden" value="{{ route('dataTinTuc') }}" id="tintucData">
                                <div class="card-body">
                                    <table class="table table-bordered" id="tintucTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th style="width:150px">Hình ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th style="width:150px">Danh mục</th>
                                                <th style="width: 40px">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbd_tintuc">
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                               
                            </div>
                         
                        </div>
                      
                    </div>
            
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script>
            $(function(){
                var urlData=$("#tintucData").val();
                $("#tintucTable").DataTable({
                    processing:true,
                    serverSide:true,
                    ajax:urlData,
                    type:'post',
                    columns:[
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data:'hinh_anh',name:'hinh_anh'},
                        {data:'TieuDeTinTuc'},
                        {data:'danhmuc',name:'danhmuc'},
                        {data:'edit_tin_tuc',name:'edit_tin_tuc'}
                    ],
                    "pageLength":10
                });
            });

            function btn_del_new(idNew)
            {
                if(confirm("Bạn chắc chắn muốn xóa chứ?")==true)
                {
                    $.ajax({
                        url:'/admin/delete-new',
                        type:'post',
                        data:{txt_id_new:idNew},
                        success:function(result){
                            toastr.success(result.message);
                            $("#tintucTable").DataTable().ajax.reload();
                        }
                    });
                }
            }
        </script>
      @endsection