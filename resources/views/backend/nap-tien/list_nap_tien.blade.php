@extends('backend.master.master')
@section('title','Thông tin nạp tiền')
@section('content')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Thông tin nạp tiền</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Nạp tiền</li>
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
                                    <h3 class="card-title">Thông tin nạp tiền</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <input type="hidden" value="{{route('naptien.data')}}" id="naptienData"/>
                                    <table class="table table-bordered" id="naptienTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th style="width: 40px">Mã khách hàng</th>
                                                <th style="width: 100px">Mã xác nhận</th>
                                                <th style="width: 170px">Tên khách hàng</th>
                                                <th style="width: 100px">Ảnh chuyển khoản</th>                                               
                                                <th>Số tiền</th>
                                                <th>Ngày</th>
                                                <th style="width: 130px">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbd_naptien">
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

        var urlData=$('#naptienData').val();
        $('#naptienTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:urlData,
            type:'post',
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'id'},
                {data:'MaXacNhan'},
                {data:'hoten',name:'hoten'},
                {data:'hinhanh',name:'hinhanh'},
                {data:'giatien',name:'giatien'},
                {data:'ngay',name:'ngay'},
                {data:'hanhdong',name:'hanhdong'},
            ],
            "pageLength":10
        });
    });


    function btn_recharge(idNapTien){
        
            $.ajax({
                url:'/admin/ajax_recharge',
                type:'post',
                data:{txt_id_naptien:idNapTien},
                success:function(result){
                    if(result.success=="success"){
                        toastr.success('Nạp tiền thành công','Thông báo');
                        $("#naptienTable").DataTable().ajax.reload();
                    }
                    else{
                        toastr.warning('Nạp tiền không thành công','Thông báo');
                        $("#naptienTable").DataTable().ajax.reload();
                    }
                    
                }
            }); 
    }

    function btn_del_recharge(id_NapTien){
        if(confirm("Bạn có chắc chắn muốn xóa?")==true){
            $.ajax({
                url:'/admin/del_recharge',
                type:'post',
                data:{txt_id_nap_tien:id_NapTien},
                success:function(result){
                    if(result.success=="success"){
                        toastr.success("Xóa thành công!",'Thông báo');
                        $("#naptienTable").DataTable().ajax.reload();
                    }
                    else{
                        toastr.warning('Xóa không thành công','Thông báo');
                        $("#naptienTable").DataTable().ajax.reload();
                    }
                }
            })
        }
    }
</script>



       @endsection

