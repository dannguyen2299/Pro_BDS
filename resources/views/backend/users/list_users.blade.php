@extends('backend.master.master')
@section('title','Danh sach người dùng')
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
                                <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                                    <h3 class="card-title">Danh sách người dùng</h3>
                                </div>
                                @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                @elseif(session()->has('err'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('err') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                @endif
                                <!-- /.card-header -->
                                <div class="card-body">
                                {{-- <input type="hidden" value="{{route('danhmuc.data')}}" id="danhmucData"/> --}}
                                    <table class="table table-bordered" id="userTables">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Ho Ten</th>
                                                
                                                <th>Email</th>
                                                <th>SDT</th>
                                                <th>Dia chi</th>      
                                                <th>Admin</th>
                                                <th>Nhan vien</th>
                                                <th>Khach hang</th>
                                                <th style="width: 130px">Hanh dong</th>
                                                <th style="width: 160px">Hanh dong</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbd_user">
                                            <?php $i=1;?>
                                            @foreach ($users as $row)
                                            
                                            <form method="POST" action="/admin/assign_role" id="frm_role">
                                            @csrf
                                            <tr>
                                                
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $row->Ho }} {{ $row->Ten }}</td>
                                        
                                                <td>{{ $row->email }}
                                                    <input type="hidden" name="email_user" value="{{ $row->email }}">
                                                </td>
                                                <td>{{ $row->Phone }}</td>
                                                <td>{{ $row->DiaChi }}</td>
                                                <td><input type="checkbox" name="role_admin" {{ $row->hasRole('Admin') ? 'checked' : '' }} ></td>
                                                <td><input type="checkbox" name="role_employy" {{ $row->hasRole('Nhân viên') ? 'checked' : '' }}></td>
                                                <td><input type="checkbox" name="role_guest" {{ $row->hasRole('Khách hàng') ? 'checked' : '' }}></td>
                                                <td><button type="submit" value="Doi Quyen" class="btn btn-primary">Doi quyen</button></td>
                                                <td>
                                                    <a id={{ $row->id }} onclick="btn_del_user('{{ $row->id }}')" class="fas fa-trash-alt"></a>
                                                    <a id="{{ $row->id }}" onclick="btn_detail('{{ $row->id }}')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Xem chi tiết</a>
                                                    
                                                </td>
                                            </tr>
                                        </form>
                                            @endforeach
                                            <?php $i++;?>
                                    
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix pull-right">
                                    {!! $users->links() !!}
                                    {{-- <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                            <!-- /.card -->


                            <!-- /.card -->
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
          {{-- <p><label for="">Họ:</label>Duy</p>
          <p><label for="">Họ:</label>Duy</p>
          <p><label for="">Họ:</label>Duy</p>
          <p><label for="">Họ:</label>Duy</p>
          <label for="">Tên: </label>Duy --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
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
          function btn_detail(idUsers){
              $.ajax({
                url:'/admin/view_users',
                type:'post',
                data:{idUsers:idUsers},
                success:function(result){
                    console.log(result);
                    var str="";
                    str+="<p><label>Họ:</label> "+result.users.Ho+"</p>";
                    str+="<p><label>Tên:</label> "+result.users.Ten+"</p>";
                    str+="<label>Ảnh:</label><p><img style='width:100px;' src=../image/avatar/users/"+result.users.AnhAvatar+"></p>";
                    str+="<p><label>Email:</label> "+result.users.email+"</p>";
                    str+="<p><label>Số điện thoại:</label> "+result.users.Phone+"</p>";
                    str+="<p><label>Địa chỉ:</label> "+result.users.DiaChi+"</p>";
                    str+="<p><label>Giới tính:</label> "+result.users.GioiTinh+"</p>";
                    str+="<p><label>Số tiền:</label> "+parseInt(result.users.SoTien).toLocaleString()+" VNĐ</p>";

                    $(".modal-body").html(str);
                }
              });
            //   var str='';
            //   str+='<p><label>Họ: </label>Duy</p>';
            //   str+='<p><label>Tên: </label>Duy</p>';
            // $(".modal-body").html(idUsers);
          }
      </script>
{{-- <script>
    $(document).ready(function() {
    $('#userTable').DataTable();
});
</script> --}}
<script>
     function btn_del_user(idUser){
        if(confirm("Ban co muon xoa khong?")==true){
            //alert(idUser);
            $.ajax({
                url:'/admin/delete_user',
                type:'post',
                data:{idUser:idUser},
                success:function(result){
                    
                    //if(result.alert){
                        toastr.warning(result.success,"Thông báo");
                        location.reload();
                   // }
                    //else{
                       // toastr.success(result.success);
                      //  location.reload();
                    //}
                    // toastr.success(result.message);
                    // $("#danhmucTable").DataTable().ajax.reload();
                }
            });
        }
    }
</script>

       @endsection

