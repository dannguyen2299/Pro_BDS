@extends('backend.master.master')
@section('title','Danh sach bat dong san')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Danh sách bất động sản</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Danh sách bất động sản</li>
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
                                    <h3 class="card-title">Danh sách bất động sản</h3>
                                    <a href="../add-category" class="btn btn-primary" style="float: right;">Thêm mới</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <input type="hidden" value="{{route('dataBDS')}}" id="bdsData"/>
                                    <table class="table table-bordered" id="bdsTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th style="width: 100px">Hình ảnh</th>
                                                <th>Tiêu đề</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Thông tin ngày</th>
                                                <th>Cập nhật lần cuối</th>
                                                <th style="width:100px">Tình trạng</th>
                                                <th style="width: 100px">Hanh dong</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbd_bds">
                                         
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                               
                            </div>
              
                        </div>
                        <!-- /.col -->
<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            
          <h5 class="modal-title" id="exampleModalLabel">Thông tin User</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div>
                        <!-- /.col -->
                    </div>
                 
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

          
        <script>

    $(function (){

        var urlData=$('#bdsData').val();
        $('#bdsTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:urlData,
            type:'post',
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'hinhanh',name:'hinhanh'},
                {data:'TieuDeBDS'},
                {data:'NgayBatDau'},
                {data:'NgayKetThuc'},
                {data:'thongtinngay',name:'thongtinngay'},
                {data:'ngaycapnhat',name:'ngaycapnhat'},
                {data:'tinhtrang',name:'tinhtrang'},
                {data:'hanhdong',name:'hanhdong'},
            ],
            "pageLength":10

        });
    });

    function btn_approve(idBDS){
        $.ajax({
            url:'/admin/approve_estate',
            type:'post',
            data:{id_bds:idBDS},
            success:function(result){
                if(result.success=="Duyệt bài thành công"){
                    $(".show").hide();
                    toastr.success(result.success,'Thông báo');
                    $("#bdsTable").DataTable().ajax.reload();
                }
                else{
                    toastr.warning(result.err,'Thông báo');
                    $("#bdsTable").DataTable().ajax.reload();
                }
            }
        });
    }

    function btn_remove(idBDS){
        $.ajax({
            url:'/admin/remove_estate',
            type:'post',
            data:{id_bds:idBDS},
            success:function(result){
                if(result.success=="Gỡ bài thành công"){
                    $(".show").hide();
                    toastr.success(result.success,'Thông báo');
                    $("#bdsTable").DataTable().ajax.reload();
                }
                else{
                    toastr.warning(result.err,'Thông báo');
                    $("#bdsTable").DataTable().ajax.reload();
                }
            }
        });
    }

    function btn_detail(id_BDS){
        $.ajax({
            url:'/admin/estate_detail',
            type:'post',
            data:{id_bds:id_BDS},
            success:function(result){
                console.log(result);
                var str="";
                str+="<p><label>Tiêu đề:</label> "+result.bds.TieuDeBDS+"</p>";
                str+="<p><label>Hình thức BĐS:</label> "+result.bds.TieuDeDM+"</p>";
                str+="<p><label>Xã/Phường:</label> "+result.bds.war+"</p>";
                str+="<p><label>Quận/Huyện:</label> "+result.bds.dic+"</p>";
                str+="<p><label>Tỉnh/Thành:</label> "+result.bds.pro+"</p>";
                if(result.bds.DienTich==0){
                    str+="<p><label>Diện tích:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Diện tích:</label> "+result.bds.DienTich+"(m²)</p>";
                }
                if(result.bds.GiaTienBDS==0){
                    str+="<p><label>Giá:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Giá:</label> "+result.bds.GiaTienBDS+" VNĐ</p>";
                }
                
                str+="<p><label>Địa chỉ BĐS:</label> "+result.bds.DiaChiBDS+"</p>";
                str+="<label>Ảnh đại diện:</label><p><img style='width:100px;' src=../image/avatar/estate/"+result.bds.AnhDaiDien+"></p>";
                str+="<p><label>Mô tả:</label> "+result.bds.MoTaBDS+"</p>";
                if(result.bds.NoiDungBDS==null){
                    str+="<p><label>Nội dung:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Nội dung:</label> "+result.bds.NoiDungBDS+"</p>";
                }
                if(result.bds.MatTien==0){
                    str+="<p><label>Mặt tiền:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Mặt tiền:</label> "+result.bds.MatTien+"(m)</p>";
                }
                if(result.bds.DuongVao==0){
                    str+="<p><label>Đường vào:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Đường vào:</label> "+result.bds.DuongVao+"(m)</p>";
                }
                
                str+="<p><label>Hướng nhà:</label> "+result.bds.HuongNha+"</p>";
                str+="<p><label>Hướng ban công:</label> "+result.bds.HuongBanCong+"</p>";
                if(result.bds.SoTang==0){
                    str+="<p><label>Số tầng:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Số tầng:</label> "+result.bds.SoTang+"</p>";
                }
                if(result.bds.SoPhongNgu==0){
                    str+="<p><label>Số phòng ngủ:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Số phòng ngủ:</label> "+result.bds.SoPhongNgu+"</p>";
                }
                if(result.bds.SoToilet==0){
                    str+="<p><label>Số Toilet:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Số Toilet:</label> "+result.bds.SoToilet+"</p>";
                }
                if(result.bds.NoiThat==null){
                    str+="<p><label>Nội thất:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Nội thất:</label> "+result.bds.NoiThat+"</p>";
                }
                if(result.bds.ThongTinPhapLy==null){
                    str+="<p><label>Thông tin pháp lý:</label> (Trống)</p>";
                }
                else{
                    str+="<p><label>Thông tin pháp lý:</label> "+result.bds.ThongTinPhapLy+"</p>";
                }
                
                str+="<label>Hình ảnh:</label></br>";
                // <p><img style='width:100px;' src=../frontend/assets/img/";
                    if(result.hinhanh.length==0){
                        str+="<p><img style='width:100px;' src=../image/estates/no-img.jpg /></p>";
                    }
                    else{
                        for(var i=0;i<result.hinhanh.length;i++){
                            str+="<img style='width:100px;margin-right:10px;' src=../image/estates/"+result.hinhanh[i].TenAnh+">";
                        }
                    }
                    
                // str+="/></p>";
                str+="<p><label>Tên liên hệ:</label> "+result.bds.TenLienHe+"</p>";
                str+="<p><label>Địa chỉ liên hệ:</label> "+result.bds.DiaChiLienHe+"</p>";
                str+="<p><label>Điện thoại:</label> "+result.bds.DienThoai+"</p>";
                str+="<p><label>Email:</label> "+result.bds.emailUser+"</p>";
                str+="<p><label>Loại tin:</label> "+result.bds.LoaiTin+"</p>";
                str+="<p><label>Ngày bắt đầu:</label> "+result.bds.NgayBatDau+"</p>";
                str+="<p><label>Ngày kết thúc:</label> "+result.bds.NgayKetThuc+"</p>";
                str+="<p><label>Người đăng:</label> "+result.bds.Ho+" "+result.bds.Ten+"</p>";
                str+="<p><label>Giới tính:</label> "+result.bds.GioiTinh+"</p>";
                str+="<p><label>Địa chỉ:</label> "+result.bds.DiaChi+"</p>";
                str+="<p><label>Phone:</label> "+result.bds.Phone+"</p>";
                $(".modal-body").html(str);

                var modal_footer="";
                modal_footer+="<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                if(result.bds.Show==null || result.bds.Show==0){
                    modal_footer+="<a onclick=btn_approve("+result.bds.idBDS+") class='btn btn-primary'>Duyệt bài</a>";
                }
                
                modal_footer+="<a class='btn btn-primary'>Chỉnh sửa</a>";

                $(".modal-footer").html(modal_footer);
            }
        });
        // 
    }

    function btn_del_bds(idBDS){
        if(confirm("Bạn có chắc chắn muốn xóa không?")==true){
            $.ajax({
                url:'/admin/delete_estate',
                type:'post',
                data:{txt_id_bds:idBDS},
                success:function(result){
                    toastr.success(result.message);
                    $("#bdsTable").DataTable().ajax.reload();
                }
            });
        }
    }
</script>
       @endsection

