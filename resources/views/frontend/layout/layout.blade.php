
<script>
    $(document).ready(function(){
        $("#frm_validate_naptien").validate({
            rules:{
                txt_numberMoney:{
                    required:true,
                    digits: true,
                    min:20000,
                },
            }, 
                messages:{
                    txt_numberMoney:{
                        required:"*Nhập số tiền muốn nạp",
                        min:"*Số tiền nạp ít nhất 20,000VNĐ",
                    },

                },
            
        });

        $("#frm_naptienbank").validate({
            rules:{
                txt_manaptien:{
                    required:true,
                    digits: true,
					equalTo: "#txt_maxacnhan"

                },

            },
            messages:{
                txt_manaptien:{
                        required:"*Không được để trống",
                        digits:"*Mã xác nhận phải là số",
                        equalTo:"*Mã xác nhận không khớp",
                    },

                },
        });
    });
</script>

<div class="col-lg-3 cont-details">
    <address id="info_user">
    
</address>
   
</div>


<!-- Modal doi pass -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" id="frm_changePass" method="post" data-route="{{ route('changePass') }}" role="form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group form_password">
                        <label for="password_old">Mật khẩu cũ</label>
                        <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Nhập mật khẩu cũ...">
                        <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        
                    </div>
                    <div id="show_errors"></div>
                    <div class="form-group form_password">
                        <label for="password">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới...">
                        <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        
                    </div>
                    <div id="show_errors1"></div>
                    <div class="form-group form_password">
                        <label for="password_confirmation">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới...">
                        <a class="eye" href="javascript:void(0)"><i class="fa fa-eye"></i></a>
                        
                    </div>
                    <div id="show_errors2"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </div>
            </div>
        </form>
      
    </div>
</div>

{{-- Modal nap tien --}}

<div class="modal fade" id="exampleModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel12" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel12">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="accordion1">
                <div class="card">
                  <div class="card-header" id="headingTwo1">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed btn_money d-flex" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                        <img class="img_bank1" src="assets/img/bank.jpg" alt=""><strong style="position: absolute;top:24px;left:78px;">Chuyển khoản ngân hàng</strong>
                        {{-- Chuyển khoản qua ngân hàng --}}
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordion1">
                    <div class="card-body">
                        <div id="box_info">
                            <div class="row" >
                            <div class="col-12">
                                <p>Để hoàn tất đơn nạp, bạn vui lòng chuyển khoản theo nội dung sau:</p>
                                <p>Ngân hàng Vietcombank (VCB): <strong class="text-danger">0123456789</strong></p>
                                <p>Chủ tài khoản: <strong class="text-danger">TRẦN THANH DUY</strong></p>
                                <p>Số tiền: <strong class="text-danger" id="txt_money_ck"></strong></p>
                                <p>Nội dung chuyển khoản: <strong class="text-danger" id="txt_numRan"></strong></p>
                            </div>
                        </div>
                        <hr>
                        <p>Sau khi chuyển khoản xong, vui lòng thông báo nạp tiền ở ô bên dưới. Mã nạp tiền là: </p>
                        <p class="text-center text-danger"><strong id="numRan1"></strong></p>

                    <form class="" id="frm_naptienbank" method="post" role="form" data-route="{{ route('recharge') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Ảnh chuyển khoản</label>
                            <div>
                              <input id="select_file_bank" type="file" name="select_file_bank" class="form-control hidden" style="display: none;"
                                onchange="changeImgBank(this)">
                            <img id="img_transfer" class="thumbnail" width="200px" height="150px" src="../backend/dist/img/import-img.png" style="cursor: pointer;border-style:groove;">
                            </div>
                            
                            </div>  
                            
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Mã xác nhận</label>
                                  <input type="number" class="form-control" id="txt_manaptien" name="txt_manaptien" placeholder="Mã nạp tiền">
                                </div>
                                <div id="show_error66"></div>
                                <input type="text" name="txt_maxacnhan" id="txt_maxacnhan">
                                <input type="text" name="txt_moneyHidden" id="txt_moneyHidden">
                                <button type="submit" class="btn btn-primary mb-2">Xác nhận</button>
                            </div> 
                        
                    </form>
                        </div>
                         
                        <div id="box_bank">
                            <div class="row" >
                                <div class="col-lg-3">
                                    <img class="img_bank" src="assets/img/vietcombank.png" alt="">
                                </div>
                                <div class="col-lg-3">
                                    <img class="img_bank" src="assets/img/viettinbank.png" alt="">
                                </div>
                                <div class="col-lg-3">
                                    <img class="img_bank" src="assets/img/techcombank.png" alt="">
                                </div>
                                <div class="col-lg-3">
                                    <img class="img_bank" src="assets/img/techcombank (1).png" alt="">
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <form action="" id="frm_validate_naptien" role="form" style="width: 100%;">
                                <div class="col-lg-12">
                                    <input type="number" class="form-control text-center" id="txt_numberMoney" name="txt_numberMoney" placeholder="Số tiền muốn nap (VNĐ)">
                                </div>
                                </form>
                                <div class="col-lg-12 mt-3"><button type="submit" class="btn btn-primary form-control" id="btn_naptien">Nạp tiền</button></div>

                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                            
                        </div>
                    </div>
                  </div>
                </div>
               
              </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () { 
        $("#box_info").hide();

        $("#btn_naptien").click(function(){
            $("#box_info").show();
            $("#box_bank").hide();
            var sotien=$("#txt_numberMoney").val();
            var money=parseInt(sotien).toLocaleString()+" VNĐ";
            $("#txt_money_ck").html(money);
            var numberRan= Math.floor(Math.random() * (999999 - 100000)) + 100000;
            var numRan="Nap BDS "+numberRan;
            $("#txt_numRan").html(numRan);
            $("#numRan1").html(numberRan);
            $("#txt_moneyHidden").val(sotien);
            $("#txt_maxacnhan").val(numberRan);
        });
     });
</script>
<script>
    $(function(){
        $("#frm_naptienbank").submit(function(e){
          
            $('.err').remove();
            $.ajax({
                type:'post',
                url:"{{ route('recharge') }}",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                processData: false,
                cache:false,
                success:function(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].txt_manaptien){
                            $("#show_error66").append('<p class="err text-danger">'+result[i].txt_manaptien+'</p>');
                        }
                        if(result[i].success){
                            toastr.success(result[i].success,'Thong bao');
                        }
                    }
                }
            });
            e.preventDefault();
        });
    });
</script>