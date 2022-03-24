@extends('backend.master.master')
@section('title','Danh sach danh muc')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Danh sách danh mục</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                                    <h3 class="card-title">Danh sách danh mục</h3>
                                    <a href="../admin/add-category" class="btn btn-primary" style="float: right;">Thêm mới</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <input type="hidden" value="{{route('danhmuc.data')}}" id="danhmucData"/>
                                    <table class="table table-bordered" id="danhmucTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Tieu de</th>
                                                <th>Mo ta</th>
                                                <th>Noi dung</th>
                                                <th>Danh muc cha</th>
                                                <th>Hien thi tren MainMenu</th>
                                                <th>Hien thi tren HeadMenu</th>
                                                <th style="width: 40px">Hanh dong</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbd_danhmuc">
                                            {{-- <tr>
                                                <td>1.</td>
                                                <td>Update software</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">55%</span></td>
                                            </tr> --}}
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                {{-- <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- /.card -->


                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->

                    <!-- /.row -->

                    <!-- /.row -->

                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <script>

    $(function (){

        var urlData=$('#danhmucData').val();
        $('#danhmucTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:urlData,
            type:'post',
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'TieuDeDanhMuc'},
                {data:'MoTaDanhMuc'},
                {data:'NoiDungDanhMuc'},
                {data:'idDanhMucCha',name:'idDanhMucCha'},
                {data:'ViewMainMenu',name:'ViewMainMenu'},
                {data:'ViewHeadMenu',name:'ViewHeadMenu'},
                {data:'edit_danh_muc',name:'edit_danh_muc'},
            ],
            "pageLength":10
        });
    });


    function btn_del_dm(idDanhMuc){
        if(confirm("Ban co muon xoa khong?")==true){
            $.ajax({
                url:'/admin/delete-category',
                type:'post',
                data:{txt_id_dm:idDanhMuc},
                success:function(result){
                    toastr.success(result.message);
                    $("#danhmucTable").DataTable().ajax.reload();
                }
            });
        }
    }
</script>
       @endsection

